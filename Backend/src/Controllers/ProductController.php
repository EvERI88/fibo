<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Products;
use App\Request\ProductsCreateRequest;
use App\Request\ProductsUpdateRequest;
use Phalcon\Http\Response;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;


class ProductController extends BaseController
{
    public function index(): mixed
    {
        $currentPage = $this->request->getQuery('page', 'int', 1);
        $limitPerPage = $this->request->getQuery('limit', 'int', 24);
        $paginator = new PaginatorModel(
            [
                'model'  => Products::class,
                'limit' => $limitPerPage,
                'page'  => $currentPage,
            ]
        );
        $page = $paginator->paginate();
        return $page;
    }

    public function create(): array
    {
        $requestValidate = new ProductsCreateRequest($this->request);
        $product = new Products();
        $data = $requestValidate->getData();

        if (!empty($requestValidate->getErrors())) {
            return [
                'status' => 'error',
                'message' => 'Ошибка валидации',
                'errors' => $requestValidate->getErrors(),
            ];
        }
        if ($this->request->hasFiles()) {
            $files = $this->request->getUploadedFiles();
            $file = $files[0];
            $filePath = 'images/products/' . $file->getName();
            $file->moveTo($filePath);
            $data['image'] = $filePath;
        }


        $product->assign($data);

        if ($product->create()) {
            return [
                'status' => 'success',
                'message' => 'Продукт успешно создан',
                'data' => $product,
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Ошибка при создании продукта',
                'errors' => $product->getMessages(),
            ];
        }
    }

    public function update($id): array
    {
        $product = Products::findFirst($id);
        $requestValidate = new ProductsUpdateRequest($this->request);
        $data = $requestValidate->getData();

        if (!$product) {
            return [
                'status' => 'error',
                'message' => 'Продукт не найден',
            ];
        }
        if (!empty($requestValidate->getErrors())) {
            return [
                'status' => 'error',
                'message' => 'Ошибка валидации',
                'errors' => $requestValidate->getErrors(),
            ];
        }
        if ($this->request->hasFiles()) {
            $files = $this->request->getUploadedFiles();
            $file = $files[0];
            $filePath = 'images/products/' . $file->getName();
            $file->moveTo($filePath);
            $data['image'] = $filePath;
        }
        $product->assign($data);

        if ($product->update()) {
            return [
                'status' => 'success',
                'message' => 'Продукт успешно обновлен',
                'data' => $product,
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Ошибка при обновлении продукта',
                'errors' => $product->getMessages(),
            ];
        }
    }

    public function delete($id): array
    {
        $product = Products::find($id);
        $product->delete();

        return [
            'status' => 'success',
            'message' => 'Продукт успешно удален',
        ];
    }
}
