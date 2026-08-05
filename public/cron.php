#!/usr/bin/env php
<?php

use App\Application;
use App\ApplicationProvider;
use Sx\Container\Injector;

require __DIR__ . '/../vendor/autoload.php';

if (!$_SERVER['HTTP_HOST']) {
    $_SERVER['HTTP_HOST'] = 'localhost';
}

$options = [];
foreach (glob(__DIR__ . '/../config/*.php') as $file) {
    $options[] = include $file;
}
$options = array_merge([], ...$options);

$injector = new Injector($options);
$injector->setup(new ApplicationProvider());

$injector->get(Application::class)();
