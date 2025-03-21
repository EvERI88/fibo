<?php

declare(strict_types=1);

namespace App\Request;

use Phalcon\Http\Request;

class ProductsUpdateRequest extends AbstractRequest
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function validate(Request $request): void
    {
        if (isset($this->data['name'])) {
            if (strlen($this->data['name']) > 255) {
                $this->errors['name'] = 'Имя продукта не может превышать 255 символов';
            } elseif (strlen($this->data['name']) < 10) {
                $this->errors['name'] = 'Короткое имя для продукта';
            }
        }

        if (isset($this->data['price'])) {
            if (!is_numeric($this->data['price'])) {
                $this->errors['price'] = 'Цена должна быть числом';
            } else if (strlen((string)$this->data['price']) < 3) {
                $this->errors['price'] = 'Цена должна содержать не менее 3 символов';
            }
        }

        if (isset($this->data['description'])) {
            if (strlen($this->data['description']) < 10) {
                $this->errors['description'] = 'Описание должно содержать не менее 10 символов';
            }
        }

        if (isset($this->data['category_id'])) {
            if (empty($this->data['category_id'])) {
                $this->errors['category_id'] = 'Категория не может быть пустой';
            }
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
