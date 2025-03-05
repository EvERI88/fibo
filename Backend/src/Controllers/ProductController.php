<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\ProductModel;

class ProductController extends BaseController
{
    public array $products = null;

    public function index(): array
    {
        return $this->products;
    }
    public function create(array $data): bool
    {
        $this->products[] = $data;
        return true;
    }
    public function update(): void {}
    public function delete(): void {}
}


// $collection->get('/', 'index');
// $collection->post('/', 'create');
// $collection->put('/{id:.+}', 'update');
// $collection->delete('/{id:.+}', 'delete');   