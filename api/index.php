<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Set storage path for Vercel
$appStoragePath = sys_get_temp_dir() . '/storage';
if (!is_dir($appStoragePath)) {
    mkdir($appStoragePath . '/framework/cache', 0755, true);
    mkdir($appStoragePath . '/framework/sessions', 0755, true);
    mkdir($appStoragePath . '/framework/views', 0755, true);
    mkdir($appStoragePath . '/logs', 0755, true);
}

// Register the Composer autoloader...
require __DIR__ . '/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__ . '/../bootstrap/app.php';

$app->handleRequest(Request::capture());
