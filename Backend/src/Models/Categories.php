<?php

declare(strict_types=1);

namespace App\Models;

class Categories extends BaseModel
{
    public ?int $id = null;
    public ?string $name = null;
    public ?string $is_visible = null;
    public ?string $updated_at = null;
    public ?string $created_at = null;
    
}
