<?php

use Phalcon\Mvc\Micro;

use Phalcon\Di\FactoryDefault;

use Phalcon\Http\Response;

class Application
{
    private $app;
    public function run(): void
    {
        $this->app = new Micro();

        $this->app->get('/health-check', function (): string {
            return json_encode(['status' => 'ok']);
        });
        $this->app->handle($_SERVER["REQUEST_URI"]);
    }

    private function setDi(): void
    {
        $di = new FactoryDefault();
        $this->setDi($di);
    }
    private function setRoutes(): void
    {
        $response = new Response();
        $response->setStatusCode(404, 'NOT FOUND');
    }

    public function init(): void
    {
        $this->setDi();
        $this->setRoutes();
    }
}
