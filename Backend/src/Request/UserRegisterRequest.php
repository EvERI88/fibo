<?php

declare(strict_types=1);


namespace App\Request;


use App\Request\AbstractRequest;
use Phalcon\Http\Request;

class UserRegisterRequest extends AbstractRequest
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }
    public function validate(Request $request): void
    {
        if (mb_strlen($this->data['telephone']) !== 11) {
            $this->errors['telephone'] = 'Неверная длина телефона';
        }
        if (mb_strlen($this->data['telephone']) < 4) {
            $this->errors['telephone'] = 'Короткое имя';
        }
        if (mb_strlen($this->data['password']) < 6) {
            $this->errors['telephone'] = 'Короткий пароль';
        }
    }
}
