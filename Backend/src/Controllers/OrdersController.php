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
        $orders = new Orders();
        $data = $ordersValidate->getData();
        if (!empty($ordersValidate->getErrors())) {
            return [
                'status' => 'error',
                'message' => 'Ошибка валидации',
                'errors' => $ordersValidate->getErrors(),
            ];
        }
        return [
            'status' => 'success',
            'errors' => $ordersValidate->getData(),
        ];
        // $orders->assign($data);

    }
}
