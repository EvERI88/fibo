<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\ProductModel;
use Phalcon\Http\Response;

class ProductController extends BaseController
{
    private object $products = null;

    public function index(): object
    {
        $this->products = new ProductModel();
        $response = $this->products->find();
        if (!(count($response))) {
            $response = [
                "success" => "false",
                "code" => "404",
                "message" => "Not Found"
            ];
        }
        return $response;
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