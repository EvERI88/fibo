<?php

declare(strict_types=1);

namespace App;

use App\Middleware\ResponseMiddleware;
use App\Models\PromoCode;
use App\Providers\ConfigProvider;
use App\Providers\DBProvider;
use App\Providers\EventsManagerProvider;
use App\Routes\CategoriesRoutes;
use App\Routes\ProductsRoutes;
use App\Routes\CommonRoutes;
use App\Routes\OrdersRoutes;
use App\Routes\PromoCodeRoutes;
use App\Routes\UserRoutes;
use Phalcon\Mvc\Micro;
use Phalcon\Di\FactoryDefault;
use Phalcon\Http\Response;

class Application
{
    private Micro $app;

    public function run(): void
    {
        $this->app = new Micro();
        $this->init();
        $this->app->after(new ResponseMiddleware());
        $this->app->handle($_SERVER["REQUEST_URI"]);
    }

    private function setDi(): void
    {
        $services = [
            new EventsManagerProvider(),
            new ConfigProvider(),
            new DBProvider(),
        ];
        $di = new FactoryDefault();
        foreach ($services as $service) {
            $di->register($service);
        }

        $this->app->setDI($di);
    }

    private function setRoutes(): void
    {

        /** @var IRoutes[] */
        $routes = [
            new ProductsRoutes(),
            new CategoriesRoutes(),
            new CommonRoutes(),
            new UserRoutes(),
            new OrdersRoutes(),
            new PromoCodeRoutes(),
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
