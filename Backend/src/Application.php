<?php

declare(strict_types=1);

namespace App;

use Phalcon\Mvc\Micro;
use Phalcon\Di\FactoryDefault;
use Phalcon\Http\Response;

class Application
{
    private Micro $app;

    public function run(): void
    {
        $this->app = new Micro();
        
        $this->setDi();
        $this->setRoutes();

        $this->app->handle($_SERVER["REQUEST_URI"]);
    }

    private function setDi(): void
    {
        $di = new FactoryDefault();
        $this->app->setDI($di);
    }

    private function setRoutes(): void
    {
        $this->app->get('/health-check', function (): string {
            return json_encode(['status' => 'ok']);
        });

        $this->app->notFound(function () {
            $response = new Response();
            $response->setStatusCode(404, 'NOT FOUND');
            $response->setContent('Not Found');
            return $response;
        });
    }

    public function init(): void
    {
        $this->setDi();
        $this->setRoutes();
    }
}
