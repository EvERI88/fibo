<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Products;
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

        $products = new Products();
        $products->assign($data);

        if ($products->create()) {
            return $this->response->setJsonContent([
                'status' => 'success',
                'message' => 'Продукт успешно создан',
                'data' => $products,
            ]);
        } else {
            return $this->response->setJsonContent([
                'status' => 'error',
                'message' => 'Ошибка при создании продукта',
                'errors' => $products->getMessages(),
            ]);
        }
    }



    public function update($id): Response
    {
        $product = Products::findFirst($id);
        $data = $this->request->getJsonRawBody(true);

        $data['is_new'] = (int)$data['is_new'];
        if ($product) {
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
        } else {
            return $this->response->setJsonContent([
                'status' => 'error',
                'message' => 'Продукт не найден',
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
