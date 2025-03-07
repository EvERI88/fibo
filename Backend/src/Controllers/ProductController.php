<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Products;
use App\Request\ProductsCreateRequest;
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
        $data = $this->request->getJsonRawBody(true);
        $requestValidate = new ProductsCreateRequest($this->request);

        if (!empty($requestValidate->getErrors())) {
            return $this->response->setJsonContent([
                'status' => 'error',
                'message' => 'Ошибка валидации',
                'errors' => $requestValidate->getErrors(),
            ]);
        }

        $product = new Products();
        $product->assign($data);

        $filePaths = [];

        if ($this->request->hasFiles()) {

            $uploadedFiles = $this->request->getUploadedFiles();

            foreach ($uploadedFiles as $file) {

                if (
                    $file->getError() === 0 &&
                    $file->getExtension() === 'png' ||
                    $file->getExtension() === 'jpg' ||
                    $file->getExtension() === 'jpeg'
                ) {
                    $filePath = 'public/images/products/' . $file->getName();
                    $file->moveTo($filePath);
                    $filePaths[] = $filePath;
                } else if ($file->getName()) {
                    return $this->response->setJsonContent([
                        'status' => 'error',
                        'message' => 'Файл уже загружен',
                    ]);
                } else {
                    return $this->response->setJsonContent([
                        'status' => 'error',
                        'message' => 'Ошибка при загрузке файла',
                    ]);
                }

                $product->image = json_encode($filePaths);
            }
        }


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
        $product = Products::findFirst($id);
        $data = $this->request->getJsonRawBody(true);
        $requestValidate = new ProductsCreateRequest($this->request);

        $data['is_new'] = (int)$data['is_new'];

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

        $product->assign($data);

        $filePaths = [];

        if ($this->request->hasFiles()) {
            $uploadedFiles = $this->request->getUploadedFiles();

            foreach ($uploadedFiles as $file) {
                if (
                    $file->getError() === 0 &&
                    $file->getExtension() === 'png' ||
                    $file->getExtension() === 'jpg' ||
                    $file->getExtension() === 'jpeg'
                ) {
                    $filePath = 'public/images/products/' . $file->getName();
                    $file->moveTo($filePath);
                    $filePaths[] = $filePath;
                } else {
                    return $this->response->setJsonContent([
                        'status' => 'error',
                        'message' => 'Ошибка при загрузке файла: ' . $file->getName(),
                    ]);
                }
            }

            $product->photos = json_encode($filePaths);
        }

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
