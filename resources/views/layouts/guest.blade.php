<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="height:100%;width:100%;margin:0;padding:0;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'BOUESTI Off-Campus Accommodation' }}</title>
    <!-- Vite compiled assets + BOUESTI brand CSS -->
    @if(file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/css/bouesti.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="{{ asset('build/assets/app-D79B-wyU.css') }}">
        <link rel="stylesheet" href="{{ asset('build/assets/bouesti-CrJiLbLU.css') }}">
    @endif
    {{ $head ?? '' }}
    <style>
        /* Guarantee full-viewport auth layout — cannot be overridden by Tailwind preflight */
        html, body { margin: 0; padding: 0; width: 100%; min-height: 100vh; }
        .bouesti-auth-wrapper { display: flex; width: 100%; min-height: 100vh; }
    </style>
</head>
<body style="margin:0;padding:0;width:100%;min-height:100vh;">
    {{ $slot }}
</body>
</html>
