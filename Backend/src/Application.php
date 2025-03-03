<?php

use Phalcon\Mvc\Micro;

class Application
{
    private $app;
    public function run()
    {
        $this->app = new Micro();

        $this->app->get('/health-check', function () {
            return json_encode(['status' => 'ok']);
        });
        $this->app->handle($_SERVER['REQUEST_URI']);
    }
}
