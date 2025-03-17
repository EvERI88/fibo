<?php

declare(strict_types=1);

namespace App\Routes;

use App\Controllers\CommonController;
use Phalcon\Mvc\Micro\Collection;

final class CommonRoutes implements IRoutes
{
    public function get(): Collection
    {
        $collection = new Collection();
        $collection->setHandler(CommonController::class, true);
        $collection->setPrefix('/common');
        $collection->get('/navigation', 'navigation');
        $collection->get('/menu', 'menu');
        $collection->get('/new', 'new');
        $collection->post('/basket', 'getBasketItem');
        return $collection;
    }
}
