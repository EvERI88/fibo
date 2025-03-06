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

        $data = [
            'name' => $this->request->getPost('name', 'string'),
            'price' => $this->request->getPost('price', 'int'),
            'image' => $this->request->getPost('image', 'string'),
            'is_new' => $this->request->getPost('is_new', 'boolean'),
            'description' => $this->request->getPost('description', 'string'),
            'category_id' => $this->request->getPost('category_id', 'int'),
        ];


        $products = new Products();
        $products->beforeCreate();
        $products->assign($data);

        if ($products->save()) {
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



    public function update(): Response
    {
        $idProduct = $this->request->getQuery('id');

        $product = Products::findFirst($idProduct);

        $data = $this->request->getJsonRawBody(true);

        if ($product) {
            $product->assign([
                'name' => $data['name'] ?? null,
                'price' => $data['price'] ?? null,
                'image' => $data['image'] ?? null,
                'is_new' => $data['is_new'] ?? null,
                'description' => $data['description'] ?? null,
                'category_id' => $data['category_id'] ?? null,
            ]);

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
                    'Products' => $product,
                ]);
            }
        } else {
            return $this->response->setJsonContent([
                'status' => 'error',
                'message' => 'Продукт не найден',
            ]);
        }
    }


    public function delete(): void {}
}
