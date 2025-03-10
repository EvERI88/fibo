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

        $data = $this->request->getRawBody();

        $product = Products::findFirst($id);

        $contentType = $this->request->getContentType();

        $requestValidate = new ProductsUpdateRequest($this->request);

        if ($contentType === 'application/json') {
            $data = $this->request->getJsonRawBody(true);
        } else {
            $data = $this->request->getRawBody();
        }


        if (!empty($requestValidate->getErrors())) {
            return $this->response->setJsonContent([
                'status' => 'error',
                'message' => 'Ошибка валидации',
                'errors' => $requestValidate->getErrors(),
            ]);
        }

        $data['is_new'] = (int)$data['is_new'];

        if (!$product) {
            return $this->response->setJsonContent([
                'status' => 'error',
                'message' => 'Продукт не найден',
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
