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

        $promoCodeRequest = new PromoCodeGetRequest($this->request);
        if (!empty($promoCodeRequest->getErrors())) {
            return [
                'status' => 'error',
                'message' => 'Ошибка валидации',
            ];
        }
        $data = $promoCodeRequest->getData();
        // $promo = $this->modelsManager->createBuilder()
        //     ->columns([
        //         'code',
        //         'status',
        //         'discount',
        //     ])
        //     ->from(PromoCode::class)
        //     ->where('code = ' . $data['code']);

        $promo = $this
            ->modelsManager
            ->createBuilder()
            ->columns([
                'code',
                'status',
                'discount',
            ])
            ->from(PromoCode::class)
            ->where('code = ' . $data['code'])
            ->getQuery()
            ->execute();

        if (count($promo) > 1) {
            return [
                'status' => 'success',
                'message' => 'Успешно активировали код',
                'code' => $promo
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Ошибка код не существует',
            ];
        }
    }
}
