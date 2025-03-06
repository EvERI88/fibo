<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\ProductModel;
use Phalcon\Http\Response;

class ProductController extends BaseController
{
    private object $products = null;

    public function index(): Response
    {
        $this->products = ProductModel::find();
        return $this->response->setJsonContent(['123' => '123']);
    }

    public function create(array $data): void {}

    public function update(): void {}
    public function delete(): void {}
}


// $collection->get('/', 'index');
// $collection->post('/', 'create');
// $collection->put('/{id:.+}', 'update');
// $collection->delete('/{id:.+}', 'delete');   