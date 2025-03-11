<?php

declare(strict_types=1);

namespace App\Request;

use Phalcon\Http\Request;

class ProductsCreateRequest extends AbstractRequest
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->validate($request);
    }

    public function validate($request): void
    {
        if (empty($this->data['name'])) {
            $this->errors['name'] = 'Имя продукта не может быть пустым';
        } else if (mb_strlen($this->data['name']) < 8) {
            $this->errors['name'] = 'Короткое имя продукта: ' . strlen($this->data['name']);
        }

        if (empty($this->data['price']) || !is_numeric($this->data['price'])) {
            $this->errors['price'] = 'Цена не может быть пустой и должна быть числом';
        } else if (mb_strlen((string)$this->data['price']) < 3) {
            $this->errors['price'] = 'Цена должна содержать не менее 3 символов';
        }

        if (empty($this->data['description'])) {
            $this->errors['description'] = 'Описание не может быть пустым';
        } else if (mb_strlen($this->data['description']) < 10) {
            $this->errors['description'] = 'Короткое описание';
        }

        if (empty($this->data['category_id'])) {
            $this->errors['category_id'] = 'Категория не может быть пустой';
        }

        if ($request->hasFiles()) {
            $uploadedFiles = $request->getUploadedFiles();
            if (count($uploadedFiles) > 1) {
                $this->errors['image'] = 'Выберите один файл';
            }
            foreach ($uploadedFiles as $file) {
                if (
                    $file->getError() !== 0 || !in_array($file->getExtension(), ['png', 'jpg', 'jpeg'])
                ) {
                    $this->errors['image'] = 'Ошибка при загрузке файла ' . $file->getName();
                }
            }
        }
    }
}
