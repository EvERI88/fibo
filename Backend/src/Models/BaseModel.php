<?php

use Phalcon\Mvc\Model;

abstract class BaseModel extends Model
{
    public $created_at;
    public $updated_at;
}
