<?php

namespace App\Providers;


use Phalcon\Events\Manager;
use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;

class EventsManagerProvider implements ServiceProviderInterface
{
    public function register(DiInterface $di): void
    {
        $di->setShared("eventsManager", fn() => new Manager());
    }
}
