<?php

declare(strict_types=1);

namespace App\Request;

use Phalcon\Http\Request;

class OrdersCreateRequest extends AbstractRequest
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function validate(Request $request): void
    {
        if (mb_strlen($this->data['name']) < 3) {
            $this->errors['name'] = 'Короткое имя: ' . strlen($this->data['name']);
        }
        if (mb_strlen($this->data['products']) < 5) {
            $this->errors['products'] = 'Выберите продукты';
        }
    }
}
