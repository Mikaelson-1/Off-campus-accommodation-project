<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Register the Composer autoloader first...
require __DIR__ . '/../vendor/autoload.php';

// Set storage path for Vercel serverless environment
$appStoragePath = sys_get_temp_dir() . '/storage';

if (!is_dir($appStoragePath . '/framework/cache')) {
    mkdir($appStoragePath . '/framework/cache', 0755, true);
}
if (!is_dir($appStoragePath . '/framework/sessions')) {
    mkdir($appStoragePath . '/framework/sessions', 0755, true);
}
if (!is_dir($appStoragePath . '/framework/views')) {
    mkdir($appStoragePath . '/framework/views', 0755, true);
}
if (!is_dir($appStoragePath . '/logs')) {
    mkdir($appStoragePath . '/logs', 0755, true);
}

// Bootstrap Laravel
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Use the temporary storage path for serverless
$app->useStoragePath($appStoragePath);

// Handle the request
$app->handleRequest(Request::capture());
