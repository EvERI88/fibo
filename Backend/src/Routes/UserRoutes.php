<?php

declare(strict_types=1);

namespace App\Routes;

use App\Controllers\UserController;
use Phalcon\Mvc\Micro\Collection;

final class UserRoutes implements IRoutes
{
    public function  get(): Collection
    {
        $collection = new Collection();
        $collection->setHandler(UserController::class, true);
        $collection->setPrefix('/user');
        $collection->post('/auth', 'authorization');
        $collection->post('/register', 'register');
        $collection->post('/check-token', 'checkToken');
        return $collection;
    }
}
