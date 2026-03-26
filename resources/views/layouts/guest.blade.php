<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'BOUESTI Off-Campus Accommodation' }}</title>
    <!-- Vite compiled assets + BOUESTI brand CSS -->
    @vite(['resources/css/app.css', 'resources/css/bouesti.css', 'resources/js/app.js'])
    {{ $head ?? '' }}
</head>
<body>
    {{ $slot }}
</body>
</html>
