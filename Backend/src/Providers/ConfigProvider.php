<?php

declare(strict_types=1);

namespace App\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Config\Config;
use Phalcon\Di\ServiceProviderInterface;

class ConfigProvider implements ServiceProviderInterface
{
    public function register(DiInterface $di): void
    {
        $di->setShared(
            "config",
            fn() => new Config(
                [
                    'db' => [
                        'adapter'  => 'mysql',
                        'host' => 'localhost',
                        'username' => 'root',
                        'password' => '123qwe',
                        'dbname' => 'fibo',
                        'charset'  => 'utf8',
                    ]
                ]
            )
        );
    }
}
