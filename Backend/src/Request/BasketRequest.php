<?php

declare(strict_types=1);

namespace App\Request;

use App\Request\AbstractRequest;
use Phalcon\Http\Request;

class BasketRequest extends AbstractRequest
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }
    public function validate(Request $request): void
    {
        if (count($this->data['products']) <= 0) {
            $this->errors['products'] = 'Корзина не может быть пустой';
        }
    }
}
