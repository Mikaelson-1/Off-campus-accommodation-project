<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landlord Dashboard — BOUESTI Accommodation</title>
    @vite(['resources/css/app.css', 'resources/css/bouesti.css', 'resources/js/app.js'])
    <style>
        body { font-family:'Inter',sans-serif; margin:0; background:#f0f2f5; }

        /* ── Navbar ─────────────────────────────────────────────────── */
        .ld-nav {
            background: linear-gradient(90deg, #0f1d3a 0%, #192F59 100%);
            height: 64px;
            display: flex; align-items: center;
            padding: 0 2rem;
            justify-content: space-between;
            box-shadow: 0 2px 12px rgba(0,0,0,.25);
            position: sticky; top: 0; z-index: 100;
        }
        .ld-nav-logo { display:flex; align-items:center; gap:.8rem; text-decoration:none; }
        .ld-nav-dot { width:38px; height:38px; background:linear-gradient(135deg,#00A553,#007f3f); border-radius:9px; display:flex; align-items:center; justify-content:center; font-weight:800; color:#fff; font-size:.9rem; }
        .ld-nav-text strong { display:block; font-size:.95rem; font-weight:800; color:#fff; }
        .ld-nav-text span { font-size:.7rem; color:rgba(255,255,255,.5); }
        .ld-nav-right { display:flex; align-items:center; gap:.75rem; }
        .ld-nav-name { color:rgba(255,255,255,.75); font-size:.88rem; }
        .ld-badge { padding:.25rem .7rem; border-radius:20px; font-size:.72rem; font-weight:700; text-transform:uppercase; letter-spacing:.4px; background:#24437e; color:#fff; }
        .ld-nav-btn { background:rgba(255,255,255,.1); border:1px solid rgba(255,255,255,.2); color:#fff; padding:.4rem 1rem; border-radius:7px; font-size:.82rem; font-weight:600; cursor:pointer; font-family:inherit; transition:background .2s; text-decoration:none; }
        .ld-nav-btn:hover { background:rgba(255,255,255,.18); }
        .ld-nav-btn-green { background:#00A553; border-color:#00A553; }
        .ld-nav-btn-green:hover { background:#007f3f; border-color:#007f3f; }

        /* ── Main Layout ─────────────────────────────────────────────── */
        .ld-body { display:flex; min-height:calc(100vh - 64px); }

        /* ── Sidebar ─────────────────────────────────────────────────── */
        .ld-sidebar {
            width: 240px; flex-shrink: 0;
            background: #fff;
            border-right: 1px solid #e5e9f0;
            padding: 1.5rem 1rem;
            display: flex; flex-direction: column; gap: .3rem;
        }
        .ld-sidebar-label { font-size: .7rem; font-weight: 700; text-transform: uppercase; letter-spacing: .7px; color: #9ca3af; padding: .6rem .75rem .3rem; margin-top: .5rem; }
        .ld-sidebar-link {
            display: flex; align-items: center; gap: .65rem;
            padding: .6rem .75rem; border-radius: 8px;
            text-decoration: none; font-size: .88rem; font-weight: 500; color: #374151;
            transition: all .18s;
        }
        .ld-sidebar-link:hover { background: #f0f2f5; color: #192F59; }
        .ld-sidebar-link.active { background: rgba(0,165,83,.1); color: #00A553; font-weight: 700; }
        .ld-sidebar-link .icon { width:20px; text-align:center; }

        /* ── Main Content ────────────────────────────────────────────── */
        .ld-main { flex: 1; padding: 2rem; overflow-x: hidden; }

        /* ── Alerts ──────────────────────────────────────────────────── */
        .ld-alert { padding: .85rem 1.1rem; border-radius: 10px; font-size: .88rem; margin-bottom: 1.5rem; display: flex; align-items: flex-start; gap: .6rem; line-height: 1.5; }
        .ld-alert-success { background: rgba(0,165,83,.09); border: 1px solid rgba(0,165,83,.3); color: #065f35; }
        .ld-alert-warning { background: rgba(240,165,0,.1); border: 1px solid rgba(240,165,0,.35); color: #6b4500; }
        .ld-alert-error   { background: rgba(229,62,62,.08); border: 1px solid rgba(229,62,62,.3); color: #7f1d1d; }

        /* ── Welcome bar ─────────────────────────────────────────────── */
        .ld-welcome { margin-bottom: 1.8rem; display: flex; align-items: flex-start; justify-content: space-between; flex-wrap: wrap; gap: 1rem; }
        .ld-welcome h1 { font-size: 1.4rem; font-weight: 800; color: #192F59; margin-bottom: .2rem; }
        .ld-welcome p  { color: #7a8ba3; font-size: .9rem; }

        /* ── Stat cards ──────────────────────────────────────────────── */
        .ld-stats { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.1rem; margin-bottom: 2rem; }
        .ld-stat { background: #fff; border-radius: 12px; padding: 1.2rem 1.3rem; box-shadow: 0 2px 10px rgba(25,47,89,.07); display: flex; align-items: center; gap: 1rem; }
        .ld-stat-icon { width: 46px; height: 46px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0; }
        .ic-green  { background: rgba(0,165,83,.12); }
        .ic-amber  { background: rgba(240,165,0,.12); }
        .ic-navy   { background: rgba(25,47,89,.09); }
        .ic-red    { background: rgba(229,62,62,.1); }
        .ld-stat-val { font-size: 1.6rem; font-weight: 800; color: #192F59; line-height: 1; }
        .ld-stat-lbl { font-size: .78rem; color: #7a8ba3; margin-top: .2rem; }

        /* ── Section card ────────────────────────────────────────────── */
        .ld-card { background: #fff; border-radius: 14px; box-shadow: 0 2px 12px rgba(25,47,89,.07); margin-bottom: 1.5rem; }
        .ld-card-header { padding: 1.2rem 1.5rem; border-bottom: 1px solid #eef1f5; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: .75rem; }
        .ld-card-header h3 { font-size: 1rem; font-weight: 700; color: #192F59; display: flex; align-items: center; gap: .5rem; }
        .ld-card-body { padding: 1.5rem; }

        /* ── Add Property Button ─────────────────────────────────────── */
        .btn-add { background:linear-gradient(135deg,#00A553,#007f3f); color:#fff; text-decoration:none; padding:.55rem 1.2rem; border-radius:8px; font-size:.85rem; font-weight:700; display:inline-flex; align-items:center; gap:.4rem; transition:all .2s; box-shadow:0 3px 10px rgba(0,165,83,.3); }
        .btn-add:hover { transform:translateY(-2px); box-shadow:0 5px 16px rgba(0,165,83,.4); }

        /* ── Properties Table ────────────────────────────────────────── */
        .prop-table { width: 100%; border-collapse: collapse; }
        .prop-table th { font-size: .75rem; font-weight: 700; text-transform: uppercase; letter-spacing: .4px; color: #7a8ba3; padding: .6rem 1rem; text-align: left; border-bottom: 2px solid #eef1f5; }
        .prop-table td { padding: .9rem 1rem; border-bottom: 1px solid #f3f4f6; font-size: .88rem; color: #374151; vertical-align: middle; }
        .prop-table tr:last-child td { border-bottom: none; }
        .prop-table tr:hover td { background: #fafbfc; }
        .prop-table .prop-title-cell { font-weight: 700; color: #192F59; }
        .prop-table .prop-thumb { width: 48px; height: 38px; object-fit: cover; border-radius: 6px; }

        /* ── Status Badge ────────────────────────────────────────────── */
        .status-badge { display: inline-flex; align-items: center; gap: .3rem; padding: .25rem .65rem; border-radius: 20px; font-size: .72rem; font-weight: 800; text-transform: uppercase; letter-spacing: .3px; }
        .status-pending  { background: rgba(240,165,0,.12); color: #92400e; }
        .status-approved { background: rgba(0,165,83,.12); color: #065f35; }
        .status-rejected { background: rgba(229,62,62,.1); color: #7f1d1d; }
        .status-archived { background: #f3f4f6; color: #6b7280; }

        /* ── Action buttons in table ─────────────────────────────────── */
        .tbl-btn { padding: .3rem .65rem; border-radius: 6px; font-size: .78rem; font-weight: 700; text-decoration: none; border: none; cursor: pointer; font-family: inherit; transition: all .15s; }
        .tbl-btn-view { background: #eef1f5; color: #192F59; }
        .tbl-btn-view:hover { background: #dce2ee; }
        .tbl-btn-del { background: rgba(229,62,62,.1); color: #c0392b; }
        .tbl-btn-del:hover { background: rgba(229,62,62,.18); }

        /* ── Empty state ─────────────────────────────────────────────── */
        .empty-state { text-align: center; padding: 3.5rem 2rem; }
        .empty-state .emoji { font-size: 2.8rem; margin-bottom: 1rem; }
        .empty-state h3 { font-size: 1.1rem; font-weight: 700; color: #192F59; margin-bottom: .4rem; }
        .empty-state p { font-size: .88rem; color: #7a8ba3; margin-bottom: 1.2rem; }

        /* ── Profile mini card ───────────────────────────────────────── */
        .profile-row { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem; }
        .profile-field label { font-size: .72rem; font-weight: 700; text-transform: uppercase; letter-spacing: .3px; color: #9ca3af; display: block; margin-bottom: .25rem; }
        .profile-field p { font-size: .9rem; font-weight: 600; color: #192F59; }

        /* ── Responsive ──────────────────────────────────────────────── */
        @media (max-width: 900px) {
            .ld-sidebar { display: none; }
            .ld-stats { grid-template-columns: repeat(2, 1fr); }
            .prop-table th:nth-child(4), .prop-table td:nth-child(4) { display: none; }
        }
        @media (max-width: 600px) {
            .ld-main { padding: 1rem; }
            .ld-stats { grid-template-columns: 1fr 1fr; }
            .ld-nav-name { display: none; }
            .profile-row { grid-template-columns: 1fr 1fr; }
        }
    </style>
</head>
<body>

<!-- ── Navbar ─────────────────────────────────────────────────────── -->
<nav class="ld-nav">
    <a href="{{ route('home') }}" class="ld-nav-logo">
        <div class="ld-nav-dot">B</div>
        <div class="ld-nav-text">
            <strong>BOUESTI</strong>
            <span>Landlord Portal</span>
        </div>
    </a>
    <div class="ld-nav-right">
        <span class="ld-nav-name">{{ auth()->user()->name }}</span>
        <span class="ld-badge">Landlord</span>
        <a href="{{ route('landlord.properties.create') }}" class="ld-nav-btn ld-nav-btn-green">+ List Property</a>
        <form method="POST" action="{{ route('logout') }}" style="display:inline">
            @csrf
            <button type="submit" class="ld-nav-btn">Sign Out</button>
        </form>
    </div>
</nav>

<div class="ld-body">
    <!-- ── Sidebar ──────────────────────────────────────────────────── -->
    <aside class="ld-sidebar">
        <div class="ld-sidebar-label">Menu</div>
        <a href="{{ route('landlord.dashboard') }}" class="ld-sidebar-link active">
            <span class="icon">🏠</span> Dashboard
        </a>
        <a href="{{ route('landlord.properties.create') }}" class="ld-sidebar-link">
            <span class="icon">➕</span> List New Property
        </a>
        <a href="{{ route('profile.edit') }}" class="ld-sidebar-link">
            <span class="icon">👤</span> My Profile
        </a>
        <div class="ld-sidebar-label">Support</div>
        <a href="{{ route('home') }}" class="ld-sidebar-link">
            <span class="icon">🌐</span> Public Site
        </a>
    </aside>

    <!-- ── Main ─────────────────────────────────────────────────────── -->
    <main class="ld-main">

        {{-- Alerts --}}
        @if(session('success'))
            <div class="ld-alert ld-alert-success">✅ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="ld-alert ld-alert-error">✕ {{ session('error') }}</div>
        @endif

        {{-- Verification Banner --}}
        @if($landlord->isPending())
            <div class="ld-alert ld-alert-warning">
                ⏳ <strong>Account Verification Pending.</strong> Your landlord account is under admin review. You can prepare your listing but cannot submit until verified.
            </div>
        @elseif($landlord->isRejected())
            <div class="ld-alert ld-alert-error">
                ✕ <strong>Verification Rejected.</strong> {{ $landlord->rejection_reason ?? 'Contact admin for details.' }}
            </div>
        @elseif($landlord->isVerified())
            <div class="ld-alert ld-alert-success">
                ✅ <strong>Verified Landlord</strong> — Your account is verified. You can list properties.
            </div>
        @endif

        {{-- Welcome + CTA --}}
        <div class="ld-welcome">
            <div>
                <h1>👋 Welcome, {{ auth()->user()->name }}!</h1>
                <p>Manage your properties, track bookings, and connect with students.</p>
            </div>
            <a href="{{ route('landlord.properties.create') }}" class="btn-add">
                ➕ Add New Property
            </a>
        </div>

        {{-- Stats --}}
        <div class="ld-stats">
            <div class="ld-stat">
                <div class="ld-stat-icon ic-green">🏠</div>
                <div>
                    <div class="ld-stat-val">{{ $properties->count() }}</div>
                    <div class="ld-stat-lbl">Total Listings</div>
                </div>
            </div>
            <div class="ld-stat">
                <div class="ld-stat-icon ic-amber">⏳</div>
                <div>
                    <div class="ld-stat-val">{{ $properties->where('status','pending')->count() }}</div>
                    <div class="ld-stat-lbl">Pending Review</div>
                </div>
            </div>
            <div class="ld-stat">
                <div class="ld-stat-icon ic-green">✅</div>
                <div>
                    <div class="ld-stat-val">{{ $properties->where('status','approved')->count() }}</div>
                    <div class="ld-stat-lbl">Approved</div>
                </div>
            </div>
            <div class="ld-stat">
                <div class="ld-stat-icon ic-red">✕</div>
                <div>
                    <div class="ld-stat-val">{{ $properties->where('status','rejected')->count() }}</div>
                    <div class="ld-stat-lbl">Rejected</div>
                </div>
            </div>
        </div>

        {{-- My Listings Table --}}
        <div class="ld-card">
            <div class="ld-card-header">
                <h3>📋 My Property Listings</h3>
                <a href="{{ route('landlord.properties.create') }}" class="btn-add" style="font-size:.82rem; padding:.45rem 1rem;">
                    ➕ New Listing
                </a>
            </div>
            <div class="ld-card-body" style="padding:0;">
                @if($properties->isEmpty())
                    <div class="empty-state">
                        <div class="emoji">🏘️</div>
                        <h3>No Properties Listed Yet</h3>
                        <p>You haven't listed any accommodation. Click the button below to add your first property.</p>
                        <a href="{{ route('landlord.properties.create') }}" class="btn-add" style="display:inline-flex;">
                            ➕ List Your First Property
                        </a>
                    </div>
                @else
                    <div style="overflow-x:auto;">
                        <table class="prop-table">
                            <thead>
                                <tr>
                                    <th>Property</th>
                                    <th>Area</th>
                                    <th>Type</th>
                                    <th>Price / Year</th>
                                    <th>Rooms</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($properties as $property)
                                <tr>
                                    <td>
                                        <div style="display:flex; align-items:center; gap:.75rem;">
                                            <img
                                                src="{{ $property->coverImageUrl() }}"
                                                alt="{{ $property->title }}"
                                                class="prop-thumb"
                                            />
                                            <div>
                                                <div class="prop-title-cell">{{ $property->title }}</div>
                                                <div style="font-size:.75rem; color:#9ca3af;">{{ Str::limit($property->address, 40) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $property->area }}</td>
                                    <td>{{ $property->typeLabel() }}</td>
                                    <td style="font-weight:700; color:#192F59;">{{ $property->formattedPrice() }}</td>
                                    <td>{{ $property->rooms_available }}/{{ $property->total_rooms }}</td>
                                    <td>
                                        <span class="status-badge status-{{ $property->status }}">
                                            @if($property->status === 'pending')  ⏳
                                            @elseif($property->status === 'approved') ✅
                                            @elseif($property->status === 'rejected') ✕
                                            @else 📁 @endif
                                            {{ $property->statusLabel() }}
                                        </span>
                                    </td>
                                    <td>
                                        <div style="display:flex; gap:.4rem; align-items:center;">
                                            <a href="{{ route('landlord.properties.show', $property) }}" class="tbl-btn tbl-btn-view">
                                                View
                                            </a>
                                            @if(in_array($property->status, ['pending','rejected']))
                                            <form method="POST" action="{{ route('landlord.properties.destroy', $property) }}"
                                                onsubmit="return confirm('Delete this property listing?');" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="tbl-btn tbl-btn-del">Delete</button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        {{-- Profile Card --}}
        <div class="ld-card">
            <div class="ld-card-header">
                <h3>👤 My Profile</h3>
                <a href="{{ route('profile.edit') }}" class="tbl-btn tbl-btn-view">Edit Profile</a>
            </div>
            <div class="ld-card-body">
                <div class="profile-row">
                    <div class="profile-field">
                        <label>Full Name</label>
                        <p>{{ auth()->user()->name }}</p>
                    </div>
                    <div class="profile-field">
                        <label>Email</label>
                        <p>{{ auth()->user()->email }}</p>
                    </div>
                    <div class="profile-field">
                        <label>Phone</label>
                        <p>{{ auth()->user()->phone ?? '—' }}</p>
                    </div>
                    <div class="profile-field">
                        <label>Business Name</label>
                        <p>{{ $landlord->business_name ?? '—' }}</p>
                    </div>
                    <div class="profile-field">
                        <label>City / State</label>
                        <p>{{ $landlord->city ?? 'Ikere-Ekiti' }}, {{ $landlord->state ?? 'Ekiti' }}</p>
                    </div>
                    <div class="profile-field">
                        <label>Verification Status</label>
                        <p style="color:{{ $landlord->isVerified() ? '#00A553' : ($landlord->isRejected() ? '#e53e3e' : '#d97706') }}; font-weight:800;">
                            {{ ucfirst($landlord->verification_status) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>
