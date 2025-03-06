<?php

declare(strict_types=1);

namespace App\Models;

use Phalcon\Filter\Validation;
use Phalcon\Filter\Validation\Validator\PresenceOf;

class Products extends BaseModel
{
    public ?int $id = null;
    public ?string $name = null;
    public ?int $price = null;
    public ?string $image = null;
    public ?int $is_new = null;
    public ?string $description = null;
    public ?string $created_at = null;
    public ?string $updated_at = null;
    public ?int $category_id = null;
}
