<?php

namespace App;

use Sx\Container\Injector;
use Sx\Container\ProviderInterface;

class ApplicationProvider implements ProviderInterface
{
    public function provide(Injector $injector): void
    {
        $injector->set(ImapRepo::class, ImapRepoFactory::class);
        $injector->set(SmtpRepo::class, SmtpRepoFactory::class);
        $injector->set(Application::class, ApplicationFactory::class);
    }
}
