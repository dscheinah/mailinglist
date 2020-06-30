<?php
$options = [];
foreach (glob('../config/*.php') as $file) {
    $options[] = include $file;
}
$options = array_merge([], ...$options);

if ($options['url'] ?? false) {
    header('Location: ' . $options['url']);
}
