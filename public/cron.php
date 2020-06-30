<?php

use App\Application;
use App\ApplicationProvider;
use Sx\Container\Injector;

require '../vendor/autoload.php';

$options = [];
foreach (glob('../config/*.php') as $file) {
    $options[] = include $file;
}
$options = array_merge([], ...$options);

$injector = new Injector($options);
$injector->setup(new ApplicationProvider());

$injector->get(Application::class)();
