<?php

use Phalcon\Mvc\Micro;

use Phalcon\Di\FactoryDefault;

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
    public function init(): void
    {
        $factory = new FactoryDefault;
        $factory->notFound(function () {
            http_response_code(404);
            return json_encode(['status' => 'NOT FOUND']);
        });
    }
}
