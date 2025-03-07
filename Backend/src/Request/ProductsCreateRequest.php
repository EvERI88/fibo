<?php

namespace App\Request;

use Phalcon\Http\Request;

class ProductsCreateRequest extends AbstractRequest
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->validate();
    }

    public function validate(): void
    {
        if (empty($this->data['name'])) {
            $this->errors['name'] = 'Имя продукта не может быть пустым';
        } else if (strlen($this->data['name']) < 4) {
            $this->errors['name'] = 'Короткое имя продукта';
        }

        if (empty($this->data['price']) || !is_numeric($this->data['price'])) {
            $this->errors['price'] = 'Цена не может быть пустой и должна быть числом';
        }

        if (empty($this->data['description'])) {
            $this->errors['description'] = 'Описание не может быть пустым';
        } else if (strlen($this->data['description']) < 10) {
            $this->errors['description'] = 'Короткое описание';
        }

        if (empty($this->data['category_id'])) {
            $this->errors['category_id'] = 'Категория не может быть пустой';
        }
    }
}
