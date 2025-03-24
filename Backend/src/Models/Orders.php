<?php

declare(strict_types=1);

namespace App\Models;

class Orders extends BaseModel
{
    public ?int $id = null;
    public ?string $number = null;
    public ?int $user_id = null;
    public ?string $name = null;
    public ?string $address = null;
    public ?string $products_id = null;
    public ?string $selected_time = null;
    public ?int $price = null;
    public ?string $method_pay = null;
    public ?int $report_bonus = null;
    public ?int $without_change = null;
    public ?int $change_money = null;
    public ?string $updated_at = null;
    public ?int $category_id = null;
    public ?int $promo_code = null;
}
