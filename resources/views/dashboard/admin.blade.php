<?php
// Admin dashboard stub
// Store in: resources/views/dashboard/admin.blade.php
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard — BOUESTI Accommodation</title>
    @vite(['resources/css/app.css', 'resources/css/bouesti.css', 'resources/js/app.js'])
</head>
<body>
<div class="bouesti-dash-wrapper">

    <!-- Header -->
    <header class="bouesti-dash-header">
        <div class="bouesti-dash-logo">
            <div class="bouesti-dash-logo-dot">B</div>
            <div class="bouesti-dash-logo-text">
                BOUESTI Accommodation
                <span>Administration Panel</span>
            </div>
        </div>
        <nav class="bouesti-dash-nav">
            <span class="user-name">{{ auth()->user()->name }}</span>
            <span class="bouesti-badge bouesti-badge-admin">Admin</span>
            <form method="POST" action="{{ route('logout') }}" style="display:inline">
                @csrf
                <button type="submit" class="bouesti-dash-logout">Sign Out</button>
            </form>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="bouesti-dash-main">
        <div class="bouesti-dash-welcome">
            <h1>👋 Welcome back, {{ auth()->user()->name }}!</h1>
            <p>Here's an overview of the BOUESTI accommodation platform.</p>
        </div>

        <!-- Stats Grid -->
        <div class="bouesti-dash-grid">
            <div class="bouesti-stat-card">
                <div class="bouesti-stat-icon green">👥</div>
                <div class="bouesti-stat-info">
                    <h3>0</h3>
                    <p>Registered Students</p>
                </div>
            </div>
            <div class="bouesti-stat-card">
                <div class="bouesti-stat-icon navy">🏠</div>
                <div class="bouesti-stat-info">
                    <h3>0</h3>
                    <p>Landlords</p>
                </div>
            </div>
            <div class="bouesti-stat-card">
                <div class="bouesti-stat-icon gold">⏳</div>
                <div class="bouesti-stat-info">
                    <h3>0</h3>
                    <p>Pending Verifications</p>
                </div>
            </div>
            <div class="bouesti-stat-card">
                <div class="bouesti-stat-icon green">🏘️</div>
                <div class="bouesti-stat-info">
                    <h3>0</h3>
                    <p>Active Listings</p>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bouesti-section-card">
            <h3>🔧 Quick Actions</h3>
            <div class="bouesti-empty-state">
                <p>Admin tools will appear here. More features coming in the next steps. ✅</p>
            </div>
        </div>

        <!-- Pending Landlord Verifications -->
        <div class="bouesti-section-card">
            <h3>📋 Pending Landlord Verifications</h3>
            <div class="bouesti-empty-state">
                <p>No pending verifications at the moment.</p>
            </div>
        </div>
    </main>
</div>
</body>
</html>
