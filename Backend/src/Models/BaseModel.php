<?php

declare(strict_types=1);

namespace App\Models;

use Phalcon\Mvc\Model;

abstract class BaseModel extends Model
{
    public ?string $created_at;
    public ?string $updated_at;

    public function beforeUpdate(): void
    {
        $this->updated_at = date("Y-m-d H:i:s");
    }

    public function beforeCreate(): void
    {
        $this->created_at = date("Y-m-d H:i:s");
        $this->updated_at = date("Y-m-d H:i:s");
    }
}
