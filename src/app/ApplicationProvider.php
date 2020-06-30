<?php

namespace App;

use Sx\Container\Injector;
use Sx\Container\ProviderInterface;
use Sx\Data\Backend\MySqlBackendFactory;
use Sx\Data\BackendInterface;
use Sx\Data\Storage;
use Sx\Data\StorageFactory;

class ApplicationProvider implements ProviderInterface
{
    public function provide(Injector $injector): void
    {
        $injector->set(BackendInterface::class, MySqlBackendFactory::class);
        $injector->set(Storage::class, StorageFactory::class);
        $injector->set(ImapRepo::class, ImapRepoFactory::class);
        $injector->set(SmtpRepo::class, SmtpRepoFactory::class);
        $injector->set(Application::class, ApplicationFactory::class);
    }
}
