<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Orders;
use App\Models\User;
use App\Request\OrdersCreateRequest;
use App\Request\OrdersGetRequest;

class OrdersController extends BaseController
{
    public function create(): array
    {
        $ordersValidate = new OrdersCreateRequest($this->request);
        $order = new Orders();
        $data = $ordersValidate->getData();

        if (!empty($ordersValidate->getErrors())) {
            return [
                'status' => 'error',
                'message' => 'Ошибка валидации',
                'errors' => $ordersValidate->getErrors(),
            ];
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
                'message' => 'Ошибка при обновлении продукта',
                'errors' => $order->getMessages(),
                'data' => $order,
            ];
        }
    }
    public function get(): array
    {
        $orderValidate = new OrdersGetRequest($this->request);
        if (!empty($orderValidate->getErrors())) {
            return [
                'status' => 'error',
                'message' => 'Ошибка при получении заказов',
                'errors' => $orderValidate->getErrors()
            ];
        }
        $data = $orderValidate->getData();
        $orders = $this->modelsManager
            ->createBuilder()
            ->columns([
                'id',
                'number',
                'name',
                'products',
                'price',
                'method_pay',
                'is_active'
            ])
            ->from(Orders::class)
            ->where('user_id = ' . $data['id'])
            ->getQuery()
            ->execute();
        $is_user = User::findFirst($data['id']);
        if (!$is_user) {
            return [
                'status' => 'error',
                'message' => 'Не найдет пользователь',
            ];
        }

        if (count($orders) > 0) {
            return [
                'status' => 'success',
                'message' => 'Найдены заказы',
                'orders' => $orders,
            ];
        } else {
            return [
                'status' => 'success',
                'message' => 'Корзина пуста',
            ];
        }
    }
}
