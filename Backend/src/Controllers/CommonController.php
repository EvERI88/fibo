<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

class CommonController extends BaseController
{
    public function navigation(): mixed
    {


        $categories = $this
            ->modelsManager
            ->createBuilder()
            ->from(Categories::class)
            ->orderBy('is_visible')
            ->getQuery()
            ->execute();
        return $categories;
    }
    public function menuProduct(): object
    {
        $categoryId = $this->request->getQuery('category_id', 'int', 0);
        $currentPage = $this->request->getQuery('page', 'int', 1);
        $limitPerPage = $this->request->getQuery('limit', 'int', 24);
        $visibleCategories = $this->navigation();

        $nameMenuCategory = '';

        foreach ($visibleCategories as $category) {
            if ($category->id === $categoryId) {
                $nameMenuCategory = $category->name;
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
            'menu' => array(
                'id' => $categoryId,
                'name' => $nameMenuCategory ? $nameMenuCategory : 'Несуществующая категория',
                'products' => $nameMenuCategory ? $paginator->paginate() : '',
            )
        );

        return $visibleData;
    }
}
