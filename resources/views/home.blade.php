<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Find verified, affordable off-campus accommodation near BOUESTI (Bells University of Technology) in Ikere-Ekiti. Browse hostels in Odo-Oja, Afon Lodge area, Temidire and more.">
    <title>BOUESTI Off-Campus Accommodation — Ikere-Ekiti</title>
    @vite(['resources/css/app.css', 'resources/css/bouesti.css', 'resources/js/app.js'])
    <style>
        /* ─── Home-Page Specific Styles ─────────────────────────────────── */

        /* NAV */
        .nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            background: rgba(25, 47, 89, 0.97);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0,0,0,.25);
            transition: background .3s;
        }
        .nav-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
            height: 68px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }
        .nav-logo {
            display: flex;
            align-items: center;
            gap: .75rem;
            text-decoration: none;
        }
        .nav-logo-dot {
            width: 38px; height: 38px;
            background: linear-gradient(135deg, #00A553, #007f3f);
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            font-weight: 800; color: #fff; font-size: .95rem;
            flex-shrink: 0;
        }
        .nav-logo-text {
            line-height: 1.2;
        }
        .nav-logo-text strong {
            display: block;
            font-size: 1rem;
            font-weight: 800;
            color: #fff;
        }
        .nav-logo-text span {
            font-size: .72rem;
            color: rgba(255,255,255,.55);
        }
        .nav-links {
            display: flex;
            align-items: center;
            gap: .5rem;
        }
        .nav-link {
            color: rgba(255,255,255,.75);
            text-decoration: none;
            font-size: .88rem;
            font-weight: 500;
            padding: .4rem .75rem;
            border-radius: 6px;
            transition: color .2s, background .2s;
        }
        .nav-link:hover { color: #fff; background: rgba(255,255,255,.1); }
        .nav-btn {
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            padding: .48rem 1.1rem;
            border-radius: 8px;
            font-size: .88rem;
            font-weight: 700;
            text-decoration: none;
            transition: all .2s;
        }
        .nav-btn-student {
            background: #00A553;
            color: #fff;
            box-shadow: 0 3px 10px rgba(0,165,83,.4);
        }
        .nav-btn-student:hover { background: #007f3f; transform: translateY(-1px); }
        .nav-btn-landlord {
            background: transparent;
            color: #fff;
            border: 1.5px solid rgba(255,255,255,.4);
        }
        .nav-btn-landlord:hover { border-color: #00A553; color: #00A553; }
        .nav-hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            background: none;
            border: none;
            padding: .4rem;
        }
        .nav-hamburger span {
            display: block;
            width: 24px; height: 2px;
            background: #fff;
            border-radius: 2px;
            transition: all .3s;
        }

        /* HERO */
        .hero {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            overflow: hidden;
            padding: 6rem 1.5rem 3rem;
        }
        .hero-bg {
            position: absolute;
            inset: 0;
            background-image: url('/images/hero-hostel.png');
            background-size: cover;
            background-position: center;
            transition: transform 8s ease-out;
        }
        .hero-bg::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(
                to bottom,
                rgba(25, 47, 89, 0.72) 0%,
                rgba(25, 47, 89, 0.55) 50%,
                rgba(0, 0, 0, 0.75) 100%
            );
        }
        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 820px;
        }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            background: rgba(0,165,83,.2);
            border: 1px solid rgba(0,165,83,.5);
            color: #5deca0;
            font-size: .8rem;
            font-weight: 700;
            letter-spacing: .5px;
            text-transform: uppercase;
            padding: .4rem 1rem;
            border-radius: 20px;
            margin-bottom: 1.3rem;
        }
        .hero-headline {
            font-size: clamp(2rem, 5vw, 3.2rem);
            font-weight: 800;
            color: #fff;
            line-height: 1.15;
            margin-bottom: .75rem;
            text-shadow: 0 2px 12px rgba(0,0,0,.35);
        }
        .hero-headline span { color: #00A553; }
        .hero-sub {
            font-size: clamp(.95rem, 2vw, 1.1rem);
            color: rgba(255,255,255,.8);
            margin-bottom: 2.5rem;
            line-height: 1.6;
        }

        /* HERO SEARCH BAR */
        .hero-search {
            background: rgba(255,255,255,.12);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(255,255,255,.25);
            border-radius: 16px;
            padding: 1.2rem 1.4rem;
            display: flex;
            flex-wrap: wrap;
            gap: .75rem;
            align-items: flex-end;
        }
        .hero-search-group {
            display: flex;
            flex-direction: column;
            gap: .3rem;
            flex: 1;
            min-width: 160px;
        }
        .hero-search-group label {
            font-size: .72rem;
            font-weight: 700;
            color: rgba(255,255,255,.75);
            text-transform: uppercase;
            letter-spacing: .4px;
        }
        .hero-search-group input,
        .hero-search-group select {
            background: rgba(255,255,255,.15);
            border: 1.5px solid rgba(255,255,255,.3);
            border-radius: 9px;
            padding: .65rem .9rem;
            color: #fff;
            font-size: .9rem;
            font-family: inherit;
            outline: none;
            transition: border-color .2s, background .2s;
            width: 100%;
        }
        .hero-search-group input::placeholder { color: rgba(255,255,255,.55); }
        .hero-search-group select option { background: #192F59; color: #fff; }
        .hero-search-group input:focus,
        .hero-search-group select:focus {
            border-color: #00A553;
            background: rgba(255,255,255,.2);
        }
        .hero-search-btn {
            background: linear-gradient(135deg, #00A553, #007f3f);
            color: #fff;
            border: none;
            border-radius: 9px;
            padding: .68rem 1.6rem;
            font-size: .95rem;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            transition: all .2s;
            display: flex;
            align-items: center;
            gap: .45rem;
            white-space: nowrap;
            box-shadow: 0 4px 14px rgba(0,165,83,.4);
            flex-shrink: 0;
        }
        .hero-search-btn:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0,165,83,.5); }

        /* Hero Stats */
        .hero-stats {
            display: flex;
            justify-content: center;
            gap: 2.5rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }
        .hero-stat {
            text-align: center;
        }
        .hero-stat strong {
            display: block;
            font-size: 1.5rem;
            font-weight: 800;
            color: #00A553;
        }
        .hero-stat span {
            font-size: .8rem;
            color: rgba(255,255,255,.65);
        }

        /* SECTIONS CONTAINER */
        .section { padding: 5rem 1.5rem; }
        .section-inner { max-width: 1200px; margin: 0 auto; }
        .section-header { text-align: center; margin-bottom: 3rem; }
        .section-eyebrow {
            display: inline-block;
            font-size: .78rem;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: #00A553;
            margin-bottom: .6rem;
        }
        .section-title {
            font-size: clamp(1.6rem, 3vw, 2.2rem);
            font-weight: 800;
            color: #192F59;
            margin-bottom: .6rem;
            line-height: 1.2;
        }
        .section-desc {
            color: #7a8ba3;
            font-size: .95rem;
            max-width: 560px;
            margin: 0 auto;
            line-height: 1.65;
        }

        /* HOW IT WORKS */
        .how-it-works { background: #f5f7fa; }
        .hiw-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2.5rem;
        }
        .hiw-panel {
            background: #fff;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(25,47,89,.07);
            border-top: 4px solid transparent;
        }
        .hiw-panel.student { border-top-color: #00A553; }
        .hiw-panel.landlord { border-top-color: #192F59; }
        .hiw-panel-header {
            display: flex;
            align-items: center;
            gap: .9rem;
            margin-bottom: 1.5rem;
        }
        .hiw-icon {
            width: 52px; height: 52px;
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }
        .hiw-icon.green { background: rgba(0,165,83,.1); }
        .hiw-icon.navy  { background: rgba(25,47,89,.08); }
        .hiw-panel-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: #192F59;
        }
        .hiw-panel-subtitle { font-size: .82rem; color: #7a8ba3; }
        .hiw-steps { list-style: none; display: flex; flex-direction: column; gap: 1rem; }
        .hiw-step {
            display: flex;
            gap: .9rem;
            align-items: flex-start;
        }
        .hiw-step-num {
            width: 30px; height: 30px;
            border-radius: 50%;
            font-size: .8rem;
            font-weight: 800;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            margin-top: .1rem;
        }
        .hiw-step-num.green { background: rgba(0,165,83,.12); color: #00A553; }
        .hiw-step-num.navy  { background: rgba(25,47,89,.1); color: #192F59; }
        .hiw-step-body h4 { font-size: .9rem; font-weight: 700; color: #374151; margin-bottom: .2rem; }
        .hiw-step-body p { font-size: .83rem; color: #7a8ba3; line-height: 1.5; }
        .hiw-cta {
            margin-top: 1.5rem;
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            font-size: .88rem;
            font-weight: 700;
            text-decoration: none;
            padding: .55rem 1.2rem;
            border-radius: 8px;
            transition: all .2s;
        }
        .hiw-cta.green { background: #00A553; color: #fff; box-shadow: 0 3px 10px rgba(0,165,83,.3); }
        .hiw-cta.green:hover { background: #007f3f; transform: translateY(-1px); }
        .hiw-cta.navy { background: #192F59; color: #fff; box-shadow: 0 3px 10px rgba(25,47,89,.25); }
        .hiw-cta.navy:hover { background: #0f1d3a; transform: translateY(-1px); }

        /* FEATURED HOSTELS */
        .featured { background: #fff; }
        .property-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.6rem;
        }
        .property-card {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(25,47,89,.09);
            transition: transform .25s, box-shadow .25s;
            background: #fff;
            display: flex;
            flex-direction: column;
        }
        .property-card:hover { transform: translateY(-5px); box-shadow: 0 10px 36px rgba(25,47,89,.15); }
        .property-img {
            position: relative;
            height: 200px;
            overflow: hidden;
        }
        .property-img img {
            width: 100%; height: 100%;
            object-fit: cover;
            transition: transform .4s;
        }
        .property-card:hover .property-img img { transform: scale(1.06); }
        .property-badge {
            position: absolute;
            top: .75rem; left: .75rem;
            background: rgba(25,47,89,.92);
            color: #fff;
            font-size: .72rem;
            font-weight: 700;
            padding: .28rem .65rem;
            border-radius: 6px;
            text-transform: uppercase;
            letter-spacing: .3px;
        }
        .property-verified {
            position: absolute;
            top: .75rem; right: .75rem;
            background: #00A553;
            color: #fff;
            font-size: .7rem;
            font-weight: 700;
            padding: .28rem .6rem;
            border-radius: 6px;
            display: flex; align-items: center; gap: .25rem;
        }
        .property-body { padding: 1.3rem; flex: 1; display: flex; flex-direction: column; }
        .property-area {
            font-size: .75rem;
            font-weight: 700;
            color: #00A553;
            text-transform: uppercase;
            letter-spacing: .4px;
            margin-bottom: .3rem;
            display: flex; align-items: center; gap: .3rem;
        }
        .property-title {
            font-size: 1.05rem;
            font-weight: 700;
            color: #192F59;
            margin-bottom: .4rem;
            line-height: 1.3;
        }
        .property-desc {
            font-size: .82rem;
            color: #7a8ba3;
            line-height: 1.55;
            margin-bottom: 1rem;
            flex: 1;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .property-amenities {
            display: flex;
            flex-wrap: wrap;
            gap: .4rem;
            margin-bottom: 1rem;
        }
        .amenity-tag {
            font-size: .72rem;
            background: #eef1f5;
            color: #374151;
            padding: .22rem .55rem;
            border-radius: 6px;
            font-weight: 600;
        }
        .property-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid #eef1f5;
            padding-top: .9rem;
            margin-top: auto;
        }
        .property-price {
            font-size: 1.2rem;
            font-weight: 800;
            color: #00A553;
        }
        .property-price span {
            font-size: .75rem;
            font-weight: 500;
            color: #7a8ba3;
        }
        .property-rooms {
            font-size: .8rem;
            color: #7a8ba3;
            display: flex; align-items: center; gap: .3rem;
        }
        .property-btn {
            background: linear-gradient(135deg, #192F59, #24437e);
            color: #fff;
            text-decoration: none;
            font-size: .82rem;
            font-weight: 700;
            padding: .5rem 1rem;
            border-radius: 8px;
            transition: all .2s;
            display: inline-flex; align-items: center; gap: .3rem;
        }
        .property-btn:hover { background: #0f1d3a; transform: translateY(-1px); }

        /* Empty state */
        .no-properties {
            grid-column: 1 / -1;
            text-align: center;
            padding: 4rem 2rem;
            color: #7a8ba3;
        }
        .no-properties h3 { font-size: 1.2rem; font-weight: 700; color: #192F59; margin-bottom: .5rem; }

        /* View All */
        .view-all {
            text-align: center;
            margin-top: 2.5rem;
        }
        .view-all-btn {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            padding: .75rem 2.2rem;
            background: transparent;
            border: 2px solid #192F59;
            border-radius: 10px;
            color: #192F59;
            font-size: .95rem;
            font-weight: 700;
            text-decoration: none;
            transition: all .2s;
        }
        .view-all-btn:hover { background: #192F59; color: #fff; }

        /* TRUST BANNER */
        .trust-banner {
            background: linear-gradient(135deg, #192F59 0%, #0f1d3a 100%);
            padding: 4rem 1.5rem;
            text-align: center;
        }
        .trust-inner { max-width: 800px; margin: 0 auto; }
        .trust-banner h2 { font-size: clamp(1.5rem, 3vw, 2rem); font-weight: 800; color: #fff; margin-bottom: .75rem; }
        .trust-banner p { color: rgba(255,255,255,.7); font-size: .95rem; margin-bottom: 2rem; line-height: 1.6; }
        .trust-btns { display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap; }
        .trust-btn-primary {
            background: #00A553; color: #fff; text-decoration: none;
            padding: .8rem 2rem; border-radius: 10px; font-weight: 700; font-size: .95rem;
            transition: all .2s; box-shadow: 0 4px 16px rgba(0,165,83,.4);
        }
        .trust-btn-primary:hover { background: #007f3f; transform: translateY(-2px); }
        .trust-btn-secondary {
            background: rgba(255,255,255,.1); color: #fff; text-decoration: none;
            padding: .8rem 2rem; border-radius: 10px; font-weight: 700; font-size: .95rem;
            border: 1.5px solid rgba(255,255,255,.3); transition: all .2s;
        }
        .trust-btn-secondary:hover { background: rgba(255,255,255,.18); border-color: #fff; }

        /* FOOTER */
        .footer {
            background: #0a1628;
            padding: 2rem 1.5rem;
            text-align: center;
        }
        .footer-inner { max-width: 1200px; margin: 0 auto; }
        .footer p { color: rgba(255,255,255,.4); font-size: .82rem; }
        .footer a { color: #00A553; text-decoration: none; }

        /* MOBILE RESPONSIVE */
        @media (max-width: 900px) {
            .hiw-grid { grid-template-columns: 1fr; }
            .property-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 600px) {
            .nav-links { display: none; flex-direction: column; position: absolute; top: 68px; left: 0; right: 0; background: rgba(25,47,89,.97); padding: 1rem 1.5rem 1.5rem; gap: .75rem; border-top: 1px solid rgba(255,255,255,.1); }
            .nav-links.open { display: flex; }
            .nav-hamburger { display: flex; }
            .nav-btn { width: 100%; justify-content: center; }
            .hero { min-height: 92vh; padding-top: 5rem; }
            .hero-search { flex-direction: column; }
            .hero-search-group { min-width: 100%; }
            .hero-search-btn { width: 100%; justify-content: center; }
            .hero-stats { gap: 1.5rem; }
            .property-grid { grid-template-columns: 1fr; }
            .section { padding: 3.5rem 1rem; }
            .hiw-panel { padding: 1.4rem; }
            .trust-btns { flex-direction: column; align-items: center; }
            .trust-btn-primary, .trust-btn-secondary { width: 100%; text-align: center; }
        }
    </style>
</head>
<body style="font-family:'Inter',sans-serif; margin:0; background:#fff;">

<!-- ════════════════════════════════════════════════════════════
     NAVIGATION
     ════════════════════════════════════════════════════════════ -->
<nav class="nav" id="mainNav">
    <div class="nav-inner">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="nav-logo">
            <div class="nav-logo-dot">B</div>
            <div class="nav-logo-text">
                <strong>BOUESTI</strong>
                <span>Off-Campus Accommodation</span>
            </div>
        </a>

        <!-- Desktop Nav Links + CTAs -->
        <div class="nav-links" id="navLinks">
            <a href="{{ route('home') }}" class="nav-link">Home</a>
            <a href="{{ route('properties.search') }}" class="nav-link">Browse Hostels</a>
            <a href="#how-it-works" class="nav-link">How It Works</a>
            <a href="{{ route('login') }}" class="nav-btn nav-btn-student" id="studentLoginBtn">
                 Student Login
            </a>
            <a href="{{ route('register') }}" class="nav-btn nav-btn-landlord" id="listPropertyBtn">
                 List Your Property
            </a>
        </div>

        <!-- Mobile Hamburger -->
        <button class="nav-hamburger" id="hamburger" aria-label="Toggle navigation" aria-expanded="false">
            <span></span><span></span><span></span>
        </button>
    </div>
</nav>

<!-- ════════════════════════════════════════════════════════════
     HERO SECTION
     ════════════════════════════════════════════════════════════ -->
<section class="hero" id="home">
    <div class="hero-bg" id="heroBg"></div>

    <div class="hero-content">
        <div class="hero-badge">
             Ikere-Ekiti, Ekiti State · Verified Listings
        </div>

        <h1 class="hero-headline">
            Find Safe, Affordable<br>
            <span>Off-Campus Accommodation</span><br>
            Near BOUESTI
        </h1>

        <p class="hero-sub">
            Verified hostels in Odo-Oja, Afon Lodge area, Temidire and beyond.<br>
            Trusted by BOUESTI students. Checked by administration.
        </p>

        <!-- Quick Search Bar -->
        <form class="hero-search" action="{{ route('properties.search') }}" method="GET" id="heroSearchForm">
            <div class="hero-search-group">
                <label for="search_location"> Location</label>
                <select name="location_id" id="search_location">
                    <option value="">All Locations</option>
                    @if($locations->where('classification', 'core_quarter')->count() > 0)
                        <optgroup label="Core Quarters">
                            @foreach($locations->where('classification', 'core_quarter') as $location)
                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                            @endforeach
                        </optgroup>
                    @endif
                    @if($locations->where('classification', 'ward')->count() > 0)
                        <optgroup label="Wards">
                            @foreach($locations->where('classification', 'ward') as $location)
                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                            @endforeach
                        </optgroup>
                    @endif
                    @if($locations->where('classification', 'neighborhood')->count() > 0)
                        <optgroup label="Neighborhoods">
                            @foreach($locations->where('classification', 'neighborhood') as $location)
                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                            @endforeach
                        </optgroup>
                    @endif
                </select>
            </div>

            <div class="hero-search-group">
                <label for="search_type"> Type</label>
                <select name="type" id="search_type">
                    <option value="">Any Type</option>
                    <option value="single_room">Single Room</option>
                    <option value="self_contain">Self Contain</option>
                    <option value="mini_flat">Mini Flat</option>
                    <option value="flat">Flat</option>
                </select>
            </div>

            <div class="hero-search-group">
                <label for="search_q"> Keyword</label>
                <input
                    type="text"
                    name="q"
                    id="search_q"
                    placeholder="e.g. Sunshine Lodge..."
                    autocomplete="off"
                />
            </div>

            <button type="submit" class="hero-search-btn">
                 Search
            </button>
        </form>

        <!-- Stats -->
        <div class="hero-stats">
            <div class="hero-stat">
                <strong>100+</strong>
                <span>Listed Properties</span>
            </div>
            <div class="hero-stat">
                <strong>500+</strong>
                <span>Students Housed</span>
            </div>
            <div class="hero-stat">
                <strong>5+</strong>
                <span>Verified Areas</span>
            </div>
        </div>
    </div>
</section>

<!-- ════════════════════════════════════════════════════════════
     HOW IT WORKS
     ════════════════════════════════════════════════════════════ -->
<section class="section how-it-works" id="how-it-works">
    <div class="section-inner">
        <div class="section-header">
            <span class="section-eyebrow">Simple. Secure. Verified.</span>
            <h2 class="section-title">How It Works</h2>
            <p class="section-desc">Whether you're a student searching for a home or a landlord wanting to list, we've made the process straightforward.</p>
        </div>

        <div class="hiw-grid">
            <!-- Students Column -->
            <div class="hiw-panel student">
                <div class="hiw-panel-header">
                    <div class="hiw-icon green"></div>
                    <div>
                        <div class="hiw-panel-title">For Students</div>
                        <div class="hiw-panel-subtitle">Secure your accommodation in minutes</div>
                    </div>
                </div>
                <ol class="hiw-steps">
                    <li class="hiw-step">
                        <div class="hiw-step-num green">1</div>
                        <div class="hiw-step-body">
                            <h4>Create a Student Account</h4>
                            <p>Register with your BOUESTI matriculation number for a verified student profile.</p>
                        </div>
                    </li>
                    <li class="hiw-step">
                        <div class="hiw-step-num green">2</div>
                        <div class="hiw-step-body">
                            <h4>Browse Verified Listings</h4>
                            <p>Filter by area, type, and price. Only admin-approved hostels are shown.</p>
                        </div>
                    </li>
                    <li class="hiw-step">
                        <div class="hiw-step-num green">3</div>
                        <div class="hiw-step-body">
                            <h4>Book & Pay Securely</h4>
                            <p>Send a booking request and pay via our secure platform. No cash scams.</p>
                        </div>
                    </li>
                    <li class="hiw-step">
                        <div class="hiw-step-num green">4</div>
                        <div class="hiw-step-body">
                            <h4>Move In Confidently</h4>
                            <p>Receive your booking confirmation and landlord contact. Move in stress-free.</p>
                        </div>
                    </li>
                </ol>
                <a href="{{ route('register') }}" class="hiw-cta green" style="margin-top:1.5rem;">
                     Register as Student →
                </a>
            </div>

            <!-- Landlords Column -->
            <div class="hiw-panel landlord">
                <div class="hiw-panel-header">
                    <div class="hiw-icon navy"></div>
                    <div>
                        <div class="hiw-panel-title">For Landlords</div>
                        <div class="hiw-panel-subtitle">Verified landlords reach thousands of students</div>
                    </div>
                </div>
                <ol class="hiw-steps">
                    <li class="hiw-step">
                        <div class="hiw-step-num navy">1</div>
                        <div class="hiw-step-body">
                            <h4>Register & Submit Documents</h4>
                            <p>Create a landlord account and upload your government ID for identity verification.</p>
                        </div>
                    </li>
                    <li class="hiw-step">
                        <div class="hiw-step-num navy">2</div>
                        <div class="hiw-step-body">
                            <h4>Wait for Admin Approval</h4>
                            <p>BOUESTI administration reviews your documents. Verified within 24–48 hours.</p>
                        </div>
                    </li>
                    <li class="hiw-step">
                        <div class="hiw-step-num navy">3</div>
                        <div class="hiw-step-body">
                            <h4>List Your Property</h4>
                            <p>Add your accommodation details, photos, price, and amenities. Submitted for admin review.</p>
                        </div>
                    </li>
                    <li class="hiw-step">
                        <div class="hiw-step-num navy">4</div>
                        <div class="hiw-step-body">
                            <h4>Receive Bookings</h4>
                            <p>Once your property is approved, students can book. Manage everything from your dashboard.</p>
                        </div>
                    </li>
                </ol>
                <a href="{{ route('register') }}" class="hiw-cta navy" style="margin-top:1.5rem;">
                     List Your Property →
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ════════════════════════════════════════════════════════════
     FEATURED HOSTELS
     ════════════════════════════════════════════════════════════ -->
<section class="section featured" id="featured">
    <div class="section-inner">
        <div class="section-header">
            <span class="section-eyebrow"> Admin-Verified Listings</span>
            <h2 class="section-title">Featured Hostels</h2>
            <p class="section-desc">Top-rated, verified accommodation options near BOUESTI campus — all checked by administration.</p>
        </div>

        <div class="property-grid">
            @forelse ($featured as $property)
                <div class="property-card">
                    <!-- Cover Image -->
                    <div class="property-img">
                        <img
                            src="{{ $property->coverImageUrl() }}"
                            alt="{{ $property->title }}"
                            loading="lazy"
                        />
                        <div class="property-badge">{{ $property->typeLabel() }}</div>
                        <div class="property-verified"> Verified</div>
                    </div>

                    <!-- Card Body -->
                    <div class="property-body">
                        <div class="property-area">
                             {{ $property->area }}, {{ $property->city }}
                        </div>
                        <div class="property-title">{{ $property->title }}</div>
                        <div class="property-desc">{{ $property->description }}</div>

                        <!-- Amenity Tags -->
                        <div class="property-amenities">
                            @if($property->has_electricity)
                                <span class="amenity-tag"> Electricity</span>
                            @endif
                            @if($property->has_water)
                                <span class="amenity-tag"> Water</span>
                            @endif
                            @if($property->has_security)
                                <span class="amenity-tag">🔒 Security</span>
                            @endif
                            @if($property->is_furnished)
                                <span class="amenity-tag"> Furnished</span>
                            @endif
                            @if($property->allows_cooking)
                                <span class="amenity-tag"> Cooking</span>
                            @endif
                        </div>

                        <!-- Footer -->
                        <div class="property-footer">
                            <div>
                                <div class="property-price">
                                    {{ $property->formattedPrice() }}
                                    <span>/ year</span>
                                </div>
                                <div class="property-rooms">
                                     {{ $property->rooms_available }} room{{ $property->rooms_available !== 1 ? 's' : '' }} available
                                </div>
                            </div>
                            <a href="{{ route('login') }}" class="property-btn">
                                View →
                            </a>
                        </div>
                    </div>
                </div>

            @empty
                <div class="no-properties">
                    <h3>No Featured Properties Yet</h3>
                    <p>Landlords are being verified and listings will appear here soon. Check back shortly!</p>
                </div>
            @endforelse
        </div>

        <div class="view-all">
            <a href="{{ route('properties.search') }}" class="view-all-btn">
                View All Properties →
            </a>
        </div>
    </div>
</section>

<!-- ════════════════════════════════════════════════════════════
     TRUST / CTA BANNER
     ════════════════════════════════════════════════════════════ -->
<section class="trust-banner">
    <div class="trust-inner">
        <h2>Ready to Find Your Perfect Accommodation?</h2>
        <p>Join hundreds of BOUESTI students who've found safe, affordable housing through our verified platform. No scams. No stress.</p>
        <div class="trust-btns">
            <a href="{{ route('register') }}" class="trust-btn-primary"> Register as Student</a>
            <a href="{{ route('register') }}" class="trust-btn-secondary"> List Your Property</a>
        </div>
    </div>
</section>

<!-- ════════════════════════════════════════════════════════════
     FOOTER
     ════════════════════════════════════════════════════════════ -->
<footer class="footer">
    <div class="footer-inner">
        <p>
            &copy; {{ date('Y') }} BOUESTI Off-Campus Accommodation System · Ikere-Ekiti, Ekiti State, Nigeria.
            <a href="{{ route('login') }}">Admin Login</a>
        </p>
    </div>
</footer>

<script>
    // ── Hamburger Menu Toggle ──────────────────────────────────────────────
    const hamburger = document.getElementById('hamburger');
    const navLinks  = document.getElementById('navLinks');
    hamburger.addEventListener('click', () => {
        const open = navLinks.classList.toggle('open');
        hamburger.setAttribute('aria-expanded', open);
    });

    // Close menu when a link is clicked
    navLinks.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => navLinks.classList.remove('open'));
    });

    // ── Nav background on scroll ──────────────────────────────────────────
    const nav = document.getElementById('mainNav');
    window.addEventListener('scroll', () => {
        nav.style.background = window.scrollY > 50
            ? 'rgba(25,47,89,1)'
            : 'rgba(25,47,89,0.97)';
    }, { passive: true });

    // ── Subtle Hero Parallax ──────────────────────────────────────────────
    const heroBg = document.getElementById('heroBg');
    window.addEventListener('scroll', () => {
        const y = window.scrollY;
        heroBg.style.transform = `translateY(${y * 0.25}px)`;
    }, { passive: true });

    // ── Smooth scroll for anchor links ───────────────────────────────────
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    });

    // ── Animate cards on scroll (Intersection Observer) ──────────────────
    const cards = document.querySelectorAll('.property-card, .hiw-step');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, i) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, i * 80);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    cards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(28px)';
        card.style.transition = 'opacity .5s ease, transform .5s ease';
        observer.observe(card);
    });
</script>
</body>
</html>
