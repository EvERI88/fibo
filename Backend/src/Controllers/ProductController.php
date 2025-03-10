<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Products;
use App\Request\ProductsCreateRequest;
use App\Request\ProductsUpdateRequest;
use Phalcon\Http\Response;

class ProductController extends BaseController
{
    public function index(): Response
    {
        $products = Products::find();
        return $this->response->setJsonContent($products);
    }

    public function create(): Response
    {
        $requestValidate = new ProductsCreateRequest($this->request);

        $product = new Products();


        if (!empty($requestValidate->getErrors())) {
            return $this->response->setJsonContent([
                'status' => 'error',
                'message' => 'Ошибка валидации',
                'errors' => $requestValidate->getErrors(),
            ]);
        }
        $data = $requestValidate->getData();


        if ($this->request->hasFiles()) {
            $files = $this->request->getUploadedFiles();
            foreach ($files as $file) {
                $filePath = 'images/products/' . $file->getName();
                $file->moveTo($filePath);
                $file->product_id = $product->id;
                $file->path = $filePath;
                $data['image'] = $filePath;
            }
        } else {
            return $this->response->setJsonContent([
                'status' => 'error',
                'message' => 'Ошибка при загрузке файла',
            ]);
        }


        $product->assign($data);



        if ($product->create()) {

            return $this->response->setJsonContent([
                'status' => 'success',
                'message' => 'Продукт успешно создан',
                'data' => $product,
            ]);
        } else {
            return $this->response->setJsonContent([
                'status' => 'error',
                'message' => 'Ошибка при создании продукта',
                'errors' => $product->getMessages(),
            ]);
        }
    }



    public function update($id): Response
    {
        var_dump(123);
        $product = Products::findFirst($id);
        $requestValidate = new ProductsUpdateRequest($this->request);

        if (!$product) {
            return $this->response->setJsonContent([
                'status' => 'error',
                'message' => 'Продукт не найден',
            ]);
        }
        if (!empty($requestValidate->getErrors())) {
            return $this->response->setJsonContent([
                'status' => 'error',
                'message' => 'Ошибка валидации',
                'errors' => $requestValidate->getErrors(),
            ]);
        }

        $data = $requestValidate->getData();

        if ($this->request->hasFiles()) {

            $files = $this->request->getUploadedFiles();
            foreach ($files as $file) {
                $filePath = 'images/products/' . $file->getName();
                $file->moveTo($filePath);
                $file->product_id = $product->id;
                $file->path = $filePath;
                $data['image'] = $filePath;
            }
        } else {
            return $this->response->setJsonContent([
                'status' => 'error',
                'message' => 'Ошибка при загрузке файла',
            ]);
        }

        $product->assign($data);

        if ($product->update()) {
            return $this->response->setJsonContent([
                'status' => 'success',
                'message' => 'Продукт успешно обновлен',
                'data' => $product,
            ]);
        } else {
            return $this->response->setJsonContent([
                'status' => 'error',
                'message' => 'Ошибка при обновлении',
                'errors' => $product->getMessages(),
            ]);
        }
    }

    public function delete($id): Response
    {
        $product = Products::find($id);
        $product->delete();

        return $this->response->setJsonContent([
            'status' => 'success',
            'message' => 'Продукт успешно удален',
        ]);
    }
}
