
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
                        'username' => 'root',
                        'password' => '123qwe',
                        'name' => 'fibo',
                        'host' => 'localhost',
                    ]
                ]
            )
        );
    }
}
