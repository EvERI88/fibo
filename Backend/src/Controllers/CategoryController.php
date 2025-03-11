<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Categories;
use App\Request\CategoryCreateRequest;

class CategoryController extends BaseController
{
    public function index(): mixed
    {
        $categories = Categories::find();
        return $categories;
    }
    public function create(): array
    {
        $requestValidate = new CategoryCreateRequest($this->request);
        $data = $requestValidate->getData();
        $categories = new Categories();

        if (!empty($requestValidate->getErrors())) {
            return [
                'status' => 'error',
                'message' => 'Ошибка валидации',
                'errors' => $requestValidate->getErrors(),
            ];
        }

        $categories->assign($data);

        if ($categories->create()) {
            return [
                'status' => 'success',
                'message' => 'Категория успешно создана',
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Ошибка при создании категории',
                'errors' => $categories->getMessages(),
            ];
        }
    }
    public function update($id): array
    {
        $category = Categories::findFirst($id);
        $requestValidate = new CategoryCreateRequest($this->request);
        $data = $requestValidate->getData();

        if ($category) {
            if (!empty($requestValidate->getErrors())) {
                return [
                    'status' => 'error',
                    'message' => 'Ошибка валидации',
                    'errors' => $requestValidate->getErrors(),
                ];
            }

            $category->assign($data);

            if ($category->update()) {
                return [
                    'status' => 'success',
                    'message' => 'Категория успешно обновлена',
                    'data' => $category,
                ];
            } else {
                return [
                    'status' => 'error',
                    'message' => 'Ошибка при обновлении категории',
                    'errors' => $category->getMessages(),
                ];
            }
        } else {
            return [
                'status' => 'error',
                'message' => 'Категория не найдена',
            ];
        }
    }
    public function delete($id): array
    {
        $category = Categories::findFirst($id);
        $category->delete();

        return [
            'status' => 'success',
            'message' => 'Категория успешно удалена'
        ];
    }
}
