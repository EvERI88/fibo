<?php

declare(strict_types=1);

namespace App\Models;

class PromoCode extends BaseModel
{
    public ?int $id = null;
    public ?int $code = null;
    public ?int $discount = null;
    public ?int $status = null;
}
