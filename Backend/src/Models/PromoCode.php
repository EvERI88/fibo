<?php

declare(strict_types=1);

namespace App\Models;

class PromoCode extends BaseModel
{
    public ?int $id = null;
    public ?int $code = null;
    public ?int $discount = null;
    public ?int $status = null;
    public ?string $created_at = null;
    public ?string $updated_at = null;
}
