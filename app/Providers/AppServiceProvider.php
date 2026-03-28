<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * Railway (and most PaaS platforms) terminate TLS at their load balancer
     * and forward requests to the app container over plain HTTP. This means
     * Laravel cannot detect HTTPS natively and will produce http:// links,
     * which modern browsers block as "mixed content".
     *
     * Solutions applied:
     *  1. Trust all proxy headers (X-Forwarded-Proto etc.) so Laravel knows
     *     the original request was HTTPS.
     *  2. In production, unconditionally force the URL scheme to https.
     */
    public function boot(): void
    {
        // Trust all proxies (Railway, Heroku, Render, etc.)
        // This lets Laravel read X-Forwarded-Proto / X-Forwarded-For correctly.
        Request::setTrustedProxies(
            ['127.0.0.1', '10.0.0.0/8', '172.16.0.0/12', '192.168.0.0/16', FILTER_VALIDATE_IP],
            Request::HEADER_X_FORWARDED_FOR |
            Request::HEADER_X_FORWARDED_HOST |
            Request::HEADER_X_FORWARDED_PORT |
            Request::HEADER_X_FORWARDED_PROTO
        );

        // Force https:// for every generated URL when APP_URL is already https
        // (covering Railway/Render/Heroku where APP_ENV may still be 'local').
        if (str_starts_with(config('app.url', ''), 'https')) {
            URL::forceScheme('https');
        }
    }
}
