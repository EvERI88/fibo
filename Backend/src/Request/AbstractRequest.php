<?php

declare(strict_types=1);

namespace App\Request;

use Phalcon\Http\Request;

abstract class AbstractRequest
{
    protected $data = [];
    protected $errors = [];

    abstract protected function validate(Request $request);

    public function __construct(Request $request)
    {
        $this->parse($request);
        $this->validate($request);
    }

    private function parse(Request $request): void
    {
        if (json_validate($request->getRawBody())) {
            $this->data = $request->getJsonRawBody(true);
        } else {
            match ($request->getMethod()) {
                'POST' => $this->data = $request->getPost(),
                'PUT' => $this->data = $request->getPut(),
                'GET' => $this->data = $request->get(),
                'DELETE' => $this->data = $request->isDelete()
            };
        }
        if ($request->hasFiles()) {
            $this->data['files'] = $request->getUploadedFiles();
        }
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
