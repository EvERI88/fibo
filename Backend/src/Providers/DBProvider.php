<?php

declare(strict_types=1);

namespace App\Providers;

use Phalcon\Db\Adapter\Pdo\Mysql;
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
        foreach ($services as $service) {
            $di->register($service);
        }
        $di->setShared('db', function () use ($di) {
            // $config = $di->get('config')->db;
            $eventsManager = $di->getShared('eventsManager');
            $options = [
                'host' => $config->host ?? 'localhost',
                'username' => $config->username ?? 'root',
                'password' => $config->password ?? '123qwe',
                'dbname' => $config->name ?? 'fibo'
            ];

            $connection = new Mysql($options);
            $connection->setEventsManager($eventsManager);
            return new Mysql([
                'host' => $config->host ?? 'localhost',
                'username' => $config->username ?? 'root',
                'password' => $config->password ?? '123qwe',
                'dbname' => $config->name ?? 'fibo'
            ]);
            return $connection;
        });
    }
}
