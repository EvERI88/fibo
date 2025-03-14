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
        if (mb_strlen($this->data['name']) < 4) {
            $this->errors['name'] = 'Короткое имя';
        }
        if (mb_strlen($this->data['password']) < 6) {
            $this->errors['password'] = 'Короткий пароль';
        }
        if ($this->data['confirmPassword'] !== $this->data['password']) {
            $this->errors['confirmPassword'] = 'Подтвердите пароль';
        }
    }
}
