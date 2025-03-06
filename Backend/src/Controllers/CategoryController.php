<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Categories;
use Phalcon\Http\Response;

class CategoryController extends BaseController
{
    public function index(): Response
    {
        $categories = Categories::find();
        return $this->response->setJsonContent($categories);
    }
    public function create(): Response
    {
        $data = $this->request->getJsonRawBody(true);

        $categories = new Categories();
        $categories->assign($data);

        if ($categories->create()) {
            return $this->response->setJsonContent([
                'status' => 'success',
                'message' => 'Продукт успешно создан',
                'data' => $data,
            ]);
        } else {
            return $this->response->setJsonContent([
                'status' => 'error',
                'message' => 'Ошибка при создании продукта',
                'errors' => $categories->getMessages(),
            ]);
        }
    }
    public function update($id): Response
    {
        $category = Categories::findFirst($id);
        $data = $this->request->getJsonRawBody(true);

        if ($category) {
            $category->assign($data);

            if ($category->update()) {
                return $this->response->setJsonContent([
                    'status' => 'success',
                    'message' => 'Категория успешно обновлен',
                    'data' => $category,
                ]);
            } else {
                return $this->response->setJsonContent([
                    'status' => 'error',
                    'message' => 'Ошибка при обновлении',
                    'errors' => $category->getMessages(),
                ]);
            }
        } else {
            return $this->response->setJsonContent([
                'status' => 'error',
                'message' => 'Категория не найден',
            ]);
        }
    }
    public function delete($id): Response
    {
        $category = Categories::find($id);
        $category->delete();

        return $this->response->setJsonContent([
            'status' => 'success',
            'message' => 'Категория успешно удалена'
        ]);
    }
}
