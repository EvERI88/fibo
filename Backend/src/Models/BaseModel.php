<?php

declare(strict_types=1);

namespace App\Models;

use Phalcon\Mvc\Model;

abstract class BaseModel extends Model
{
    public ?string $created_at = null;
    public ?string $updated_at = null;

    public function beforeValidationOnUpdate(): void
    {
        $this->updated_at = date("Y-m-d H:i:s");
    }

    public function beforeValidationOnCreate(): void
    {
        $this->created_at = date("Y-m-d H:i:s");
        $this->updated_at = date("Y-m-d H:i:s");
    }
}
