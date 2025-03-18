<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Categories;
use App\Models\Products;
use App\Request\BasketRequest;
use Phalcon\Http\Request;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

class CommonController extends BaseController
{
    public function navigation(): mixed
    {
        $categories = $this
            ->modelsManager
            ->createBuilder()
            ->columns([
                'c.id',
                'c.name',
                'COUNT(*) AS cnt'
            ])
            ->from(['p' => Products::class])
            ->innerJoin(Categories::class, 'p.category_id = c.id', 'c')
            ->groupBy('c.id')
            ->where('is_visible = 1')
            ->getQuery()
            ->execute();
        return $categories;
    }
    public function menu(): array
    {
        $visibleCategories = $this->navigation();
        $visibleData = ['menu' => []];

        foreach ($visibleCategories as $category) {
            $products = $this
                ->modelsManager
                ->createBuilder()
                ->columns([
                    'id',
                    'name',
                    'image',
                    'price',
                    'description',
                    'is_new'
                ])
                ->from(Products::class)
                ->where('category_id = ' . $category->id)
                ->getQuery()
                ->execute();

            $visibleData['menu'][] = [
                'id' => $category->id,
                'name' => $category->name,
                'products' => $products,
            ];
        }
        return $visibleData;
    }
    public function new(): array
    {
        $products = $this
            ->modelsManager
            ->createBuilder()
            ->columns([
                'id',
                'name',
                'image',
                'price',
            ])
            ->from(Products::class)
            ->where('is_new = 1')
            ->limit(4)
            ->getQuery()
            ->execute();
        $visibleData['new'] = [
            'products' => $products,
        ];
        return $visibleData;
    }


    public function getBasketItem(): array
    {
        $requestBasket = new BasketRequest($this->request);

        if (!empty($requestBasket->getErrors())) {
            return [
                'status' => 'error',
                'message' => 'Корзина пустая',
                'errors' => $requestBasket->getErrors(),
            ];
        }

        $data = $requestBasket->getData();

        if (empty($data['products'])) {
            return [
                'status' => 'error',
                'message' => 'Нет продуктов в корзине',
            ];
        }

        $products = $this
            ->modelsManager
            ->createBuilder()
            ->columns([
                'p.id',
                'p.name',
                'p.price',
                'p.description',
                'p.image'
            ])
            ->from(['p' => Products::class])
            ->inWhere(
                "p.id",
                $data['products']
            )
            ->getQuery()
            ->execute();

        return [
            'status' => 'success',
            'products' => $products->toArray()
        ];
    }

    // public function menuGetCategory(): object
    // {
    //     $categoryId = $this->request->getQuery('category_id', 'int', 0);
    //     $currentPage = $this->request->getQuery('page', 'int', 1);
    //     $limitPerPage = $this->request->getQuery('limit', 'int', 24);
    //     $visibleCategories = $this->navigation();

    //     $nameMenuCategory = '';

    //     foreach ($visibleCategories as $category) {
    //         if ($category->id === $categoryId) {
    //             $nameMenuCategory = $category->name;
    //         }
    //     }

    //     $paginator = new PaginatorModel(
    //         [
    //             'model'  => Products::class,
    //             'limit' => $limitPerPage,
    //             'page'  => $currentPage,
    //             "parameters" => [
    //                 "category_id = :cst_id:",
    //                 "bind" => [
    //                     "cst_id" => $categoryId
    //                 ],
    //             ],
    //         ]
    //     );

    //     if ($nameMenuCategory) {
    //         $visibleData = (object) [
    //             'menu' => array(
    //                 'id' => $categoryId,
    //                 'name' => $nameMenuCategory,
    //                 'products' => $paginator->paginate()
    //             )
    //         ];
    //     } else {
    //         $visibleData = (object) array(
    //             'error' => 'Несуществующая категория: ' . $categoryId
    //         );
    //     }


    //     return $visibleData;
    // }
}
