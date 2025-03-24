<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\PromoCode;
use App\Request\PromoCodeCreateRequest;
use App\Request\PromoCodeGetRequest;

class PromoCodeController extends BaseController
{
    public function create(): array
    {
        $promoCodeRequest = new PromoCodeCreateRequest($this->request);
        $data = $promoCodeRequest->getData();
        $promoCode = new PromoCode();

        if (!empty($promoCodeRequest->getErrors())) {
            return [
                'status' => 'error',
                'message' => 'Ошибка валидации',
                'errors' => $promoCodeRequest->getErrors(),
            ];
        }

        $promoCode->assign($data);

        if ($promoCode->create()) {
            return [
                'status' => 'success',
                'message' => 'Промокод добавлен',
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Ошибка при создании',
            ];
        }
    }
    public function get(): array
    {

        $requestCode = new PromoCodeGetRequest($this->request);
        $data = $requestCode->getData();

        if ($data['code']) {
            if (!empty($requestCode->getErrors())) {
                return [
                    'status' => 'error',
                    'message' => 'Ошибка валидации',
                    'error' => 'validate',
                ];
            }

            $code = $this->modelsManager
                ->createBuilder()
                ->columns([
                    'id',
                    'discount',
                    'code',
                    'status',
                ])
                ->from(PromoCode::class)
                ->where('code = ' . $data['code'])
                ->andWhere('status = 1')
                ->getQuery()
                ->execute();


            if (count($code)) {
                return [
                    'status' => 'success',
                    'message' => 'Найден код',
                    'code' => $code
                ];
            } else {
                return [
                    'error' => 'notFound',
                    'status' => 'error',
                    'message' => 'Код не найден',
                ];
            }
        } else {
            return [
                'error' => 'empty',
                'status' => 'error',
                'message' => 'Введите промокод',
            ];
        }
    }
}
