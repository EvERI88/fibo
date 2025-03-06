<?php

declare(strict_types=1);

namespace App;

use App\Middleware\ResponseMiddleware;
use App\Providers\ConfigProvider;
use App\Providers\DBProvider;
use App\Routes\CategoriesRoutes;
use App\Routes\ProductsRoutes;
use Phalcon\Di\DiInterface;
use Phalcon\Mvc\Micro;
use Phalcon\Di\FactoryDefault;
use Phalcon\Http\Response;

class Application
{
    private Micro $app;

    public function run(): void
    {
        $this->app = new Micro();

        $services = [
            new ConfigProvider(),
            new DBProvider(),
        ];
        $di = new FactoryDefault();
        foreach ($services as $service) {
            $di->register($service);
        }

        $this->init();

        $this->app->after(new ResponseMiddleware());

        $this->app->handle($_SERVER["REQUEST_URI"]);
    }

    private function setDi(): void
    {
        $di = new FactoryDefault();
        $this->app->setDI($di);
    }

    private function setRoutes(): void
    {

        /** @var IRoutes[] */
        $routes = [
            new ProductsRoutes(),
            new CategoriesRoutes(),
        ];

        foreach ($routes as $route) {
            $this->app->mount($route->get());
        }
        $this->app->get('/health-check', function (): string {
            return json_encode(['status' => 'ok']);
        });

        $this->app->notFound(function () {
            $response = new Response();
            $response->setStatusCode(404, 'NOT FOUND');
            $response->setJsonContent(['error' => 'Not found']);
            return $response;
        });
    }

    public function init(): void
    {
        $this->setDi();

        $this->setRoutes();
    }
}
