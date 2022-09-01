<?php

require_once __DIR__.'/../vendor/autoload.php';

error_reporting(0);

(new App\Service\LoadEnvironmentVariables(
    dirname(__DIR__)
))->bootstrap();

date_default_timezone_set(env('APP_TIMEZONE', 'UTC'));

$app = new App\Core\Application(dirname(__DIR__));


return $app;