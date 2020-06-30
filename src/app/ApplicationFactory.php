<?php

namespace App;

use Sx\Container\FactoryInterface;
use Sx\Container\Injector;
use Sx\Data\Storage;

class ApplicationFactory implements FactoryInterface
{
    public function create(Injector $injector, array $options, string $class): Application
    {
        return new Application(
            $injector->get(Storage::class),
            $injector->get(ImapRepo::class),
            $injector->get(SmtpRepo::class),
            $options['query'] ?? ''
        );
    }
}
