<?php

declare(strict_types=1);

namespace App\Controllers;


class ProductController extends BaseController
{
    public array $products = null;

    public function index(): void 
    {
    }
    public function create(): void {}
    public function update(): void {}
    public function delete(): void {}
}


// $collection->get('/', 'index');
// $collection->post('/', 'create');
// $collection->put('/{id:.+}', 'update');
// $collection->delete('/{id:.+}', 'delete');