<?php

/**
 * Point d'entrée Vercel pour Laravel.
 * Les fichiers écrits doivent aller dans /tmp (filesystem Vercel en lecture seule).
 */

$vercelTmp = '/tmp';

foreach ([
    'VIEW_COMPILED_PATH' => $vercelTmp.'/views',
    'APP_SERVICES_CACHE' => $vercelTmp.'/services.php',
    'APP_PACKAGES_CACHE' => $vercelTmp.'/packages.php',
    'APP_CONFIG_CACHE' => $vercelTmp.'/config.php',
    'APP_ROUTES_CACHE' => $vercelTmp.'/routes.php',
    'APP_EVENTS_CACHE' => $vercelTmp.'/events.php',
] as $key => $value) {
    if (empty($_ENV[$key] ?? getenv($key) ?: null)) {
        putenv("{$key}={$value}");
        $_ENV[$key] = $value;
        $_SERVER[$key] = $value;
    }
}

if (! is_dir($vercelTmp.'/views')) {
    @mkdir($vercelTmp.'/views', 0755, true);
}

if (! is_dir($vercelTmp.'/storage/framework/cache')) {
    @mkdir($vercelTmp.'/storage/framework/cache', 0755, true);
}

require __DIR__.'/../public/index.php';
