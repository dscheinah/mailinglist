<?php

namespace App;

use Eden;
use Sx\Container\FactoryInterface;
use Sx\Container\Injector;

Eden::DECORATOR;

class ImapRepoFactory implements FactoryInterface
{
    public function create(Injector $injector, array $options, string $class): ImapRepo
    {
        /* @var Eden\Mail\Imap $connector */
        $connector = eden('mail')->imap(
            $options['imap']['server'],
            $options['imap']['user'],
            $options['imap']['password'],
            $options['imap']['port'],
            true
        );
        $connector->setActiveMailbox($options['imap']['mailbox']);
        return new ImapRepo($connector);
    }
}
