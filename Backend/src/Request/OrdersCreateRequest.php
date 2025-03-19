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

        $delivery = $this->data['delivery'];

        if (empty($delivery['home'])) {
            $this->errors['name'] = 'Дом не может быть пустым';
        } else if (mb_strlen($delivery['address']) < 5) {
            $this->errors['name'] = 'Короткий адрес';
        }
    }
}
