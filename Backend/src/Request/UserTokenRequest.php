<?php

declare(strict_types=1);

namespace App\Request;

use App\Request\AbstractRequest;
use Phalcon\Http\Request;

class UserTokenRequest extends AbstractRequest
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }
    public function validate(Request $request): void {}
}
