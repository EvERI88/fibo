<?php

use App\Application;

require __DIR__ . '/../vendor/autoload.php';

try {
    $app = new Application();
    $app->run();
} catch (\Throwable $th) {
    var_dump($th->getMessage());
    var_dump($th->getTraceAsString());
}
