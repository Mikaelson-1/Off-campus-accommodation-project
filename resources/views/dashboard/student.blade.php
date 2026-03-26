<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Dashboard — BOUESTI Accommodation</title>
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
                <span>Student Portal</span>
            </div>
        </div>
        <nav class="bouesti-dash-nav">
            <span class="user-name">{{ auth()->user()->name }}</span>
            <span class="bouesti-badge bouesti-badge-student">Student</span>
            <form method="POST" action="{{ route('logout') }}" style="display:inline">
                @csrf
                <button type="submit" class="bouesti-dash-logout">Sign Out</button>
            </form>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="bouesti-dash-main">
        <div class="bouesti-dash-welcome">
            <h1>👋 Hello, {{ auth()->user()->name }}!</h1>
            <p>Find verified, affordable off-campus accommodation around BOUESTI.</p>
        </div>

        <!-- Stats Grid -->
        <div class="bouesti-dash-grid">
            <div class="bouesti-stat-card">
                <div class="bouesti-stat-icon green">🔍</div>
                <div class="bouesti-stat-info">
                    <h3>0</h3>
                    <p>Saved Listings</p>
                </div>
            </div>
            <div class="bouesti-stat-card">
                <div class="bouesti-stat-icon navy">📋</div>
                <div class="bouesti-stat-info">
                    <h3>0</h3>
                    <p>Active Bookings</p>
                </div>
            </div>
            <div class="bouesti-stat-card">
                <div class="bouesti-stat-icon gold">⭐</div>
                <div class="bouesti-stat-info">
                    <h3>0</h3>
                    <p>Reviews Given</p>
                </div>
            </div>
            <div class="bouesti-stat-card">
                <div class="bouesti-stat-icon green">✅</div>
                <div class="bouesti-stat-info">
                    <h3>0</h3>
                    <p>Verified Properties</p>
                </div>
            </div>
        </div>

        <!-- Student Profile Info -->
        @if(auth()->user()->student)
        <div class="bouesti-section-card">
            <h3>🎓 My Profile</h3>
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
                <div>
                    <p style="font-size:.8rem; color:var(--bouesti-gray-500); text-transform:uppercase; font-weight:600; letter-spacing:.3px;">Matriculation No.</p>
                    <p style="font-weight:600; color:var(--bouesti-navy); margin-top:.2rem;">
                        {{ auth()->user()->student->matriculation_number }}
                    </p>
                </div>
                <div>
                    <p style="font-size:.8rem; color:var(--bouesti-gray-500); text-transform:uppercase; font-weight:600; letter-spacing:.3px;">Department</p>
                    <p style="font-weight:600; color:var(--bouesti-navy); margin-top:.2rem;">
                        {{ auth()->user()->student->department ?? '—' }}
                    </p>
                </div>
                <div>
                    <p style="font-size:.8rem; color:var(--bouesti-gray-500); text-transform:uppercase; font-weight:600; letter-spacing:.3px;">Level</p>
                    <p style="font-weight:600; color:var(--bouesti-navy); margin-top:.2rem;">
                        {{ auth()->user()->student->level ? auth()->user()->student->level . 'L' : '—' }}
                    </p>
                </div>
                <div>
                    <p style="font-size:.8rem; color:var(--bouesti-gray-500); text-transform:uppercase; font-weight:600; letter-spacing:.3px;">Faculty</p>
                    <p style="font-weight:600; color:var(--bouesti-navy); margin-top:.2rem;">
                        {{ auth()->user()->student->faculty ?? '—' }}
                    </p>
                </div>
            </div>
        </div>
        @endif

        <!-- Available Listings Placeholder -->
        <div class="bouesti-section-card">
            <h3>🏘️ Available Listings Near Campus</h3>
            <div class="bouesti-empty-state">
                <p>No listings available yet. Check back soon — landlords are onboarding! 🏠</p>
            </div>
        </div>
    </main>
</div>
</body>
</html>
