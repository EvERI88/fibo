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
    public ?bool $is_admin = null;
}
