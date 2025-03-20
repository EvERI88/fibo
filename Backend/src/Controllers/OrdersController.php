<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Orders;
use App\Request\OrdersCreateRequest;

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
}
