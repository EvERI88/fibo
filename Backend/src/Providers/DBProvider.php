<?php

declare(strict_types=1);

namespace App\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\FactoryDefault;
use Phalcon\Di\ServiceProviderInterface;

class DBProvider implements ServiceProviderInterface
{
    public function register(DiInterface $di): void
    {
        $services = [
            new ConfigProvider(),
            new DBProvider(),
        ];
        $di = new FactoryDefault();
        foreach($services as $service) {
            $di->register($service);
        }
    }
}
