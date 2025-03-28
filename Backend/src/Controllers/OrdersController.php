<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Orders;
use App\Models\PromoCode;
use App\Models\User;
use App\Request\OrdersCreateRequest;
use App\Request\OrdersGetRequest;
use Phalcon\Paginator\Adapter\QueryBuilder;

class OrdersController extends BaseController
{
    public function create(): array
    {
        $ordersValidate = new OrdersCreateRequest($this->request);
        $order = new Orders();
        $data = $ordersValidate->getData();

        $promo = PromoCode::findFirst([
            'conditions' => 'id = ?1 AND status = 1',
            'bind' => [
                1 => $data['promo_code_id'],
            ],
        ]);

        if (!empty($ordersValidate->getErrors())) {
            return [
                'status' => 'error',
                'message' => 'Ошибка валидации',
                'errors' => $ordersValidate->getErrors(),
            ];
        }

        if ($promo) {
            $promo->status = 0;
            if (!$promo->update()) {
                return [
                    'status' => 'error',
                    'message' => 'Ошибка при изменении статуса промокода',
                    'errors' => $promo->getMessages(),
                ];
            }
        }

        $order->assign($data);

        if ($order->create()) {
            return [
                'status' => 'success',
                'message' => 'Заказ успешно создан',
                'data' => $order,
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Ошибка при создании',
                'errors' => $order->getMessages(),
                'data' => $order,
            ];
        }
    }

    public function get(): array
    {

        $currentPage = $this->request->getQuery('page', 'int', 1);
        $limitPerPage = $this->request->getQuery('limit', 'int', 2);


        $orderValidate = new OrdersGetRequest($this->request);
        if (!empty($orderValidate->getErrors())) {
            return [
                'status' => 'error',
                'message' => 'Ошибка при получении заказов',
                'errors' => $orderValidate->getErrors()
            ];
        }
        $data = $orderValidate->getData();
        $orders = $this->modelsManager->createBuilder()
            ->columns([
                'id',
                'number',
                'name',
                'products',
                'price',
                'method_pay',
                'user_id',
                'is_active'
            ])
            ->from(Orders::class)
            ->where('user_id = ' . $data['id']);

        $is_user = User::findFirst($data['id']);
        if (!$is_user) {
            return [
                'status' => 'error',
                'message' => 'Не найдет пользователь',
            ];
        }

        $paginate = new QueryBuilder(
            [
                "builder" => $orders,
                "limit" => $limitPerPage,
                "page" => $currentPage
            ]
        );

        if (count($paginate->paginate()->items) > 0) {
            return [
                'status' => 'success',
                'message' => 'Найдены заказы',
                'orders' => $paginate->paginate(),
            ];
        } else {
            return [
                'status' => 'success',
                'message' => 'Корзина пуста',
            ];
        }
    }
}
