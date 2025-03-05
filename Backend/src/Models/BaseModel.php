<?php

declare(strict_types=1);

namespace App\Models;

use Phalcon\Mvc\Model;

abstract class BaseModel extends Model
{
    public $created_at = date("Y-m-d H:i:s");
    public $updated_at = date("Y-m-d H:i:s");

    public function initialize(): void
    {
        $this->updated_at = date("Y-m-d H:i:s");
    }
}
