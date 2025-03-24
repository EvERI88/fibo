<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\BaseModel;

class User extends BaseModel
{
    public ?int $id = null;
    public ?string $name = null;
    public ?string $telephone = null;
    public ?string $password = null;
    public ?int $is_admin = null;
    public ?string $created_at = null;
    public ?string $updated_at = null;
}
