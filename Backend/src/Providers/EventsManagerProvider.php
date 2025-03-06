<?php

namespace App\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\FactoryDefault;
use Phalcon\Events\Manager;

class EventsManagerProvider extends Manager
{
    public function run(): void
    {
        $di = new FactoryDefault();
        $di->setShared("eventsManager", fn() => new Manager());
    }
}
