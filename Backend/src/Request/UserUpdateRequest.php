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
        // if (preg_match('/^\+?\d+$/', $value)) {
        //     echo "Целое положительное число :-)";
        // }

    }
}
