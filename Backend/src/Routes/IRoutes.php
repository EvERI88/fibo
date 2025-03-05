<?php

declare(strict_types=1);

namespace App\Routes;

use Phalcon\Mvc\Micro\Collection;

interface IRoutes
{
    public function get(): Collection;
}
