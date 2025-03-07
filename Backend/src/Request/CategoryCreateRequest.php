<?php

namespace App\Request;

use Phalcon\Http\Request;

class CategoryCreateRequest extends AbstractRequest
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->validate();
    }

    public function validate(): void
    {
        if (empty($this->data['name'])) {
            $this->errors['name'] = 'Наименование категории не может быть пустым';
        } else if (strlen($this->data['name']) < 4) {
            $this->errors['name'] = 'Короткое наименование категории';
        }
    }
}
