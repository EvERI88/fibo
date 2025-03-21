<?php

declare(strict_types=1);

namespace App\Request;

use App\Request\AbstractRequest;
use Phalcon\Http\Request;

class UserUpdateRequest extends AbstractRequest
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }
    public function validate(Request $request): void
    {

        if (empty($this->data['name'])) {
            $this->errors['name'] = 'Имя пользователя не может быть пустым';
        } else if (mb_strlen($this->data['name']) < 6) {
            $this->errors['name'] = 'Короткое имя пользователя: ';
        }

        // if (preg_match('/^\+?\d+$/', $value)) {
        //     echo "Целое положительное число :-)";
        // }

    }
}
