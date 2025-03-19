<?php

declare(strict_types=1);

namespace App\Routes;

use App\Controllers\OrdersController;
use Phalcon\Mvc\Micro\Collection;

final class OrdersRoutes implements IRoutes
{
    public function get(): Collection
    {
        $collection = new Collection();
        $collection->setHandler(OrdersController::class, true);
        $collection->setPrefix('/orders');
        $collection->post('/create', 'create');
        return $collection;
    }
}
