<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

class CommonController extends BaseController
{
    public function navigation(): array
    {
        $categories = Categories::find();
        $visibleCategories = [];
        foreach ($categories as $category) {
            if ($category->is_visible === '1') {
                array_push($visibleCategories, $category);
            }
        }

        return $visibleCategories;
    }
    public function menuProduct(): object
    {
        $categoryId = $this->request->getQuery('category_id', 'int', 0);
        $currentPage = $this->request->getQuery('page', 'int', 1);
        $limitPerPage = $this->request->getQuery('limit', 'int', 24);

        $products = Products::find();

        $visibleCategories = $this->navigation();
        $visibleProducts = [];

        foreach ($products as $product) {
            if ($product->category_id === $categoryId) {
                array_push($visibleProducts, $product);
            }
        }

        $paginator = new PaginatorModel(
            [
                'model'  => Products::class,
                'limit' => $limitPerPage,
                'page'  => $currentPage,
                "parameters" => [
                    "category_id = :cst_id:",
                    "bind" => [
                        "cst_id" => $categoryId
                    ],
                ],
            ]
        );

        $visibleData = (object) array(
            'categories' => $visibleCategories,
            'products' => $visibleProducts ? $paginator->paginate() : 'Нету продуктов у такой категории',
        );

        return $visibleData;
    }
}
