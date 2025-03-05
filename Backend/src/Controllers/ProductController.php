<?php

declare(strict_types=1);

namespace App\Controllers;

// use Phalcon\Tag;
// use App\Models\ProductModel;
// use Phalcon\Http\Request;

class ProductController extends BaseController
{
    public array $products = null;

    public function init(): void
    {
        // $this->tag->title()->set('Products');
    }
    public function createAction(): void {}

    public function indexAction(): void {}

    public function updateAction(): void {}
    public function deleteAction(): void {}
}


// $collection->get('/', 'index');
// $collection->post('/', 'create');
// $collection->put('/{id:.+}', 'update');
// $collection->delete('/{id:.+}', 'delete');