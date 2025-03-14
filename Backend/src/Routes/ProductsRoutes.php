<?php

declare(strict_types=1);

namespace App\Routes;

use App\Controllers\ProductController;
use Phalcon\Mvc\Micro\Collection;

final class ProductsRoutes implements IRoutes
{
    public function  get(): Collection
    {
        $collection = new Collection();
        $collection->setHandler(ProductController::class, true);
        $collection->setPrefix('/products');
        $collection->get('/', 'index');
        $collection->post('/', 'create');
        $collection->post('/{id:.+}', 'update');
        $collection->delete('/{id:.+}', 'delete');
        return $collection;
    }
}
