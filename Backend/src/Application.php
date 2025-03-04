<?php

// require __DIR__ . '../vendor/autoload.php';

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
    public function init(): void
    {
        $response = new Response();
        $response->setStatusCode(404, 'NOT FOUND');
        $factory = new FactoryDefault;
        $factory->setDi($response);
        // DI protected function
    }
}
