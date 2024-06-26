<?php

use Illuminate\Cache\CacheManager;
use Illuminate\Container\Container;

$container = new Container();
$cacheManager = new CacheManager($container);

$cacheConfig = [
    'driver' => 'file',
    'path' => __DIR__ . '/cache', // Cache-Verzeichnis
];

$container['config'] = [
    'cache.default' => $cacheConfig['driver'],
    'cache.stores.file' => $cacheConfig,
];

return $cacheManager->store();
