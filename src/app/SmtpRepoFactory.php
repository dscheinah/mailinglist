<?php

namespace App;

use Eden;
use Sx\Container\FactoryInterface;
use Sx\Container\Injector;

Eden::DECORATOR;

class SmtpRepoFactory implements FactoryInterface
{
    public function create(Injector $injector, array $options, string $class): SmtpRepo
    {
        return new SmtpRepo(
            eden('mail')->smtp(
                $options['smtp']['server'],
                $options['smtp']['user'],
                $options['smtp']['password'],
                $options['smtp']['port'],
                true
            )
        );
    }
}
