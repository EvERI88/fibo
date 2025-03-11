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
        $categoryId = $this->request->getQuery('category', 'int', 0);
        $currentPage = $this->request->getQuery('page', 'int', 1);
        $limitPerPage = $this->request->getQuery('limit', 'int', 24);

        $paginator = new PaginatorModel(
            [
                'model'  => Products::class,
                'limit' => $limitPerPage,
                'page'  => $currentPage,
            ]
        );

        $products = Products::find();
        $productsPagination = $paginator->paginate();
        $visibleCategories = $this->navigation();
        $visibleProducts = [];
        if ($categoryId !== 0) {
            foreach ($products as $product) {
                if ($product->category_id === $categoryId) {
                    array_push($visibleProducts, $product);
                }
            }
        } else {
            $visibleProducts = $products;
        }

        $visibleData = (object) array(
            'categories' => $visibleCategories,
            'products' => $visibleProducts ? $visibleProducts : 'Нету продуктов у такой категории'
        );

        return $visibleData;
    }
}
