<?php

declare(strict_types=1);

namespace App\Request;

use Phalcon\Http\Request;

class PromoCodeCreateRequest extends AbstractRequest
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function validate(Request $request): void
    {
        if (isset($this->data['code'])) {
            if (!is_numeric($this->data['code'])) {
                $this->errors['code'] = 'Код должен быть числом';
            } else if (strlen((string)$this->data['code']) <= 3) {
                $this->errors['code'] = 'Код должен содержать не менее 4 символов';
            } else if (strlen((string)$this->data['code']) >= 9) {
                $this->errors['code'] = 'Код должен содержать не более 9 символов';
            }
        }
        if (isset($this->data['discount'])) {
            if (!is_numeric($this->data['discount'])) {
                $this->errors['discount'] = 'Скидка должна быть числом';
            } else if (strlen((string)$this->data['discount']) <= 0) {
                $this->errors['discount'] = 'Скидка должна содержать 1-3 символа';
            } else if (strlen((string)$this->data['discount']) > 3) {
                $this->errors['discount'] = 'Скидка не должна содержать более 3 символов';
            }
        }
    }
}
