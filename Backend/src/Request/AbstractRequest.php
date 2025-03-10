<?php

declare(strict_types=1);

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
        if (json_validate($request->getRawBody())) {
            $this->data = $request->getJsonRawBody(true);
        } else {
            switch ($request->getMethod()) {
                case 'POST':
                    $this->data = $request->getPost();
                    break;
                case 'PUT':
                    $this->data = $request->getPut();
                    break;
                case 'GET':
                    $this->data = $request->get();
                    break;
                case 'DELETE':
                    $this->data = $request->isDelete();
                    break;
            }
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
