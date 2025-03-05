<?php

declare(strict_types=1);

namespace App\Models;

class ProductModel extends BaseModel
{
    public ?string $name = null;
    public ?int $price = null;
    public ?string $image = null;
    public ?bool $is_new = null;
    public ?string $description = null;
    public ?int $category_id = null;
    public ?string $updated_at = null;
    public ?string $created_at = null;
}
