<?php

namespace App\Request;

use Phalcon\Http\Request;

abstract class AbstractRequest
{
    protected $data = [];
    protected $errors = [];

    public function __construct(Request $request)
    {
        $this->parse($request);
    }

    protected function parse(Request $request): void
    {
        $this->data = $request->getJsonRawBody(true);
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    abstract public function validate(): void;
}
