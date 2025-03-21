<?php

declare(strict_types=1);

namespace App\Routes;

use App\Controllers\PromoCodeController;
use Phalcon\Mvc\Micro\Collection;

final class PromoCodeRoutes implements IRoutes
{
    public function  get(): Collection
    {
        $collection = new Collection();
        $collection->setHandler(PromoCodeController::class, true);
        $collection->setPrefix('/promo');
        $collection->post('/create', 'create');
        $collection->post('/', 'get');
        return $collection;
    }
}
