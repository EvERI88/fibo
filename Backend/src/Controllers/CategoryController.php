<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Categories;
use App\Request\CategoryCreateRequest;
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
        $requestValidate = new CategoryCreateRequest($this->request);

        if (!empty($requestValidate->getErrors())) {
            return $this->response->setJsonContent([
                'status' => 'error',
                'message' => 'Ошибка валидации',
                'errors' => $requestValidate->getErrors(),
            ]);
        }
        $data = $requestValidate->getData();

        $categories = new Categories();
        $categories->assign($data);

        if ($categories->create()) {
            return $this->response->setJsonContent([
                'status' => 'success',
                'message' => 'Категория успешно создана',
            ]);
        } else {
            return $this->response->setJsonContent([
                'status' => 'error',
                'message' => 'Ошибка при создании категории',
                'errors' => $categories->getMessages(),
            ]);
        }
    }
    public function update($id): Response
    {
        $category = Categories::findFirst($id);

        $requestValidate = new CategoryCreateRequest($this->request);

        if ($category) {
            if (!empty($requestValidate->getErrors())) {
                return $this->response->setJsonContent([
                    'status' => 'error',
                    'message' => 'Ошибка валидации',
                    'errors' => $requestValidate->getErrors(),
                ]);
            }
            $data = $requestValidate->getData();

            $category->assign($data);

            if ($category->update()) {
                return $this->response->setJsonContent([
                    'status' => 'success',
                    'message' => 'Категория успешно обновлена',
                    'data' => $category,
                ]);
            } else {
                return $this->response->setJsonContent([
                    'status' => 'error',
                    'message' => 'Ошибка при обновлении категории',
                    'errors' => $category->getMessages(),
                ]);
            }
        } else {
            return $this->response->setJsonContent([
                'status' => 'error',
                'message' => 'Категория не найдена',
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
