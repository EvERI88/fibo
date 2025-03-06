<?php

declare(strict_types=1);

namespace App\Providers;

use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;

class DBProvider implements ServiceProviderInterface
{
    public function register(DiInterface $di): void
    {
        $di->setShared('db', function () use ($di) {
            $dbConfig = $di->getShared('config')->db;
            return new Mysql([
                'adapter' => $dbConfig->adapter ?? 'mysql',
                'host' => $dbConfig->host ?? 'localhost',
                'username' => $dbConfig->username ?? 'root',
                'password' => $dbConfig->password ?? '123qwe',
                'dbname' => $dbConfig->dbname ?? 'fibo',
                'charset' => $dbConfig->charset ?? 'utf-8',
                'dbname' => $dbConfig->name ?? 'fibo',
                'dbname' => $dbConfig->name ?? 'fibo',
            ]);
        });
    }
}


// 'adapter'  => 'mysql',
// 'host' => 'localhost',
// 'username' => 'root',
// 'password' => '123qwe',
// 'dbname' => 'fibo',
// 'charset'  => 'utf8',