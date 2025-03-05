<?php

declare(strict_types=1);

namespace App\Routes;

use App\Controllers\CategoryController;
use Phalcon\Mvc\Micro\Collection;

final class CategoriesRoutes
{
    public function get(): Collection
    {
        $collection = new Collection();
        $collection->setHandler(CategoryController::class, true);
        $collection->setPrefix('/categories');
        $collection->get('/', 'index');
        $collection->post('/', 'create');
        $collection->put('/{id:.+}', 'update');
        $collection->delete('/{id:.+}', 'delete');
        return $collection;
    }
}
