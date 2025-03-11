<?php

declare(strict_types=1);

namespace App\Middleware;

use Phalcon\Http\Response;
use Phalcon\Mvc\Micro;
use Phalcon\Mvc\Micro\MiddlewareInterface;

class ResponseMiddleware implements MiddlewareInterface
{
    public function call(Micro $application)
    {

        $data = $application->getReturnedValue();

        $responseHeaders = [
            'Origin',
            'Accept',
            'X-Requested-With',
            'Content-Range',
            'Content-Disposition',
            'Content-Type',
            'Access-Token',
            'Authorization',
            'X-Authorization',
            'X-Unicorn-Version',
            "Set-Cookie"
        ];


        $response = new Response();
        $response->setHeader("Access-Control-Allow-Origin", '*')
            ->setHeader("Access-Control-Allow-Methods", 'GET,POST,PUT,DELETE')
            ->setHeader("Access-Control-Allow-Headers", implode(",", $responseHeaders))
            ->setHeader("Access-Control-Allow-Credentials", true)
            ->setHeader("Access-Control-Max-Age", 3600)
            ->setContentType('application/json', 'UTF-8')
            ->setJsonContent($data)
            ->send($data);
    }
}
