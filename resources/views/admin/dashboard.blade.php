<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard — BOUESTI Accommodation</title>
    @vite(['resources/css/app.css', 'resources/css/bouesti.css', 'resources/js/app.js'])
    <style>
        /* ═══════════════════════════════════════════════════════════════
           BOUESTI ADMIN SHELL — Shared across all admin views
           ═══════════════════════════════════════════════════════════════ */
        *, *::before, *::after { box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; margin: 0; background: #f0f2f5; color: #374151; }

        /* ── Top Bar ─────────────────────────────────────────────────── */
        .admin-topbar {
            position: sticky; top: 0; z-index: 200;
            background: linear-gradient(90deg, #0d1b34 0%, #192F59 100%);
            height: 60px;
            display: flex; align-items: center;
            padding: 0 1.5rem;
            gap: 1rem;
            box-shadow: 0 2px 16px rgba(0,0,0,.3);
        }
        .topbar-hamburger { display: none; flex-direction: column; gap: 5px; cursor: pointer; background: none; border: none; padding: .3rem; }
        .topbar-hamburger span { display: block; width: 22px; height: 2px; background: rgba(255,255,255,.7); border-radius: 2px; }
        .topbar-logo { display: flex; align-items: center; gap: .65rem; text-decoration: none; }
        .topbar-logo-dot { width: 34px; height: 34px; background: linear-gradient(135deg, #00A553, #007f3f); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-weight: 900; color: #fff; font-size: .85rem; }
        .topbar-logo-text strong { display: block; font-size: .9rem; font-weight: 800; color: #fff; }
        .topbar-logo-text span { font-size: .65rem; color: rgba(255,255,255,.45); text-transform: uppercase; letter-spacing: .5px; }
        .topbar-spacer { flex: 1; }
        .topbar-admin-name { font-size: .82rem; color: rgba(255,255,255,.65); }
        .topbar-badge { padding: .22rem .6rem; border-radius: 20px; font-size: .68rem; font-weight: 800; letter-spacing: .4px; text-transform: uppercase; background: rgba(229,62,62,.25); color: #ff6b6b; }
        .topbar-logout { background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.2); color: rgba(255,255,255,.75); padding: .38rem .9rem; border-radius: 7px; font-size: .8rem; font-weight: 600; cursor: pointer; font-family: inherit; transition: all .2s; }
        .topbar-logout:hover { background: rgba(255,255,255,.18); color: #fff; }

        /* ── Layout ──────────────────────────────────────────────────── */
        .admin-shell { display: flex; min-height: calc(100vh - 60px); }

        /* ── Sidebar ─────────────────────────────────────────────────── */
        .admin-sidebar {
            width: 230px; flex-shrink: 0;
            background: #fff;
            border-right: 1px solid #e5e9f0;
            padding: 1.2rem .8rem;
            display: flex; flex-direction: column;
            transition: transform .25s;
            overflow-y: auto;
        }
        .sidebar-label { font-size: .67rem; font-weight: 800; text-transform: uppercase; letter-spacing: .8px; color: #b0b8c8; padding: .6rem .7rem .25rem; margin-top: .4rem; }
        .sidebar-item {
            display: flex; align-items: center; gap: .65rem;
            padding: .58rem .8rem;
            border-radius: 9px;
            text-decoration: none;
            font-size: .86rem; font-weight: 500; color: #374151;
            transition: all .15s;
            position: relative;
        }
        .sidebar-item:hover { background: #f0f2f5; color: #192F59; }
        .sidebar-item.active { background: rgba(0,165,83,.1); color: #00A553; font-weight: 700; }
        .sidebar-item.active::before { content: ''; position: absolute; left: 0; top: 25%; height: 50%; width: 3px; background: #00A553; border-radius: 0 3px 3px 0; }
        .sidebar-item .s-icon { width: 20px; text-align: center; font-size: 1rem; }
        .sidebar-badge { margin-left: auto; background: #e53e3e; color: #fff; font-size: .66rem; font-weight: 800; padding: .18rem .45rem; border-radius: 10px; min-width: 20px; text-align: center; }
        .sidebar-divider { height: 1px; background: #eef1f5; margin: .6rem 0; }

        /* ── Main content ────────────────────────────────────────────── */
        .admin-main { flex: 1; padding: 1.8rem; overflow-x: hidden; }

        /* ── Page header ─────────────────────────────────────────────── */
        .page-hdr { display: flex; align-items: flex-start; justify-content: space-between; flex-wrap: wrap; gap: 1rem; margin-bottom: 1.8rem; }
        .page-hdr-title { font-size: 1.3rem; font-weight: 800; color: #192F59; margin-bottom: .2rem; display: flex; align-items: center; gap: .5rem; }
        .page-hdr-sub { font-size: .85rem; color: #7a8ba3; }

        /* ── Alerts ──────────────────────────────────────────────────── */
        .alert { padding: .85rem 1.1rem; border-radius: 10px; font-size: .87rem; margin-bottom: 1.4rem; display: flex; align-items: flex-start; gap: .5rem; line-height: 1.5; }
        .alert-success { background: rgba(0,165,83,.09); border: 1px solid rgba(0,165,83,.3); color: #065f35; }
        .alert-error   { background: rgba(229,62,62,.07); border: 1px solid rgba(229,62,62,.25); color: #7f1d1d; }

        /* ── Stat Cards ──────────────────────────────────────────────── */
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.1rem; margin-bottom: 2rem; }
        .stat-card { background: #fff; border-radius: 13px; padding: 1.2rem 1.4rem; box-shadow: 0 2px 12px rgba(25,47,89,.07); display: flex; align-items: center; gap: 1rem; transition: transform .2s, box-shadow .2s; border-left: 4px solid transparent; }
        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(25,47,89,.1); }
        .stat-card.green  { border-left-color: #00A553; }
        .stat-card.amber  { border-left-color: #f59e0b; }
        .stat-card.navy   { border-left-color: #192F59; }
        .stat-card.red    { border-left-color: #e53e3e; }
        .stat-card.purple { border-left-color: #7c3aed; }
        .stat-icon { width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; flex-shrink: 0; }
        .ic-g { background: rgba(0,165,83,.1); }
        .ic-a { background: rgba(245,158,11,.1); }
        .ic-n { background: rgba(25,47,89,.09); }
        .ic-r { background: rgba(229,62,62,.1); }
        .ic-p { background: rgba(124,58,237,.1); }
        .stat-val { font-size: 1.7rem; font-weight: 800; color: #192F59; line-height: 1; }
        .stat-lbl { font-size: .76rem; color: #7a8ba3; margin-top: .2rem; }

        /* ── Section card ────────────────────────────────────────────── */
        .card { background: #fff; border-radius: 14px; box-shadow: 0 2px 12px rgba(25,47,89,.07); margin-bottom: 1.5rem; overflow: hidden; }
        .card-hdr { padding: 1rem 1.4rem; border-bottom: 1px solid #f0f2f5; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: .75rem; }
        .card-hdr h3 { font-size: .95rem; font-weight: 700; color: #192F59; display: flex; align-items: center; gap: .45rem; }
        .card-hdr-actions { display: flex; align-items: center; gap: .5rem; }

        /* ── Data Table ──────────────────────────────────────────────── */
        .tbl-wrap { overflow-x: auto; }
        .data-table { width: 100%; border-collapse: collapse; font-size: .86rem; }
        .data-table thead th {
            background: #f8fafc; padding: .7rem 1rem; text-align: left;
            font-size: .72rem; font-weight: 700; text-transform: uppercase;
            letter-spacing: .5px; color: #7a8ba3;
            border-bottom: 2px solid #eef1f5;
            white-space: nowrap;
        }
        .data-table tbody td { padding: .85rem 1rem; border-bottom: 1px solid #f3f4f6; vertical-align: middle; }
        .data-table tbody tr:last-child td { border-bottom: none; }
        .data-table tbody tr:hover td { background: #fafbfc; }
        .data-table .col-img { width: 52px; height: 40px; object-fit: cover; border-radius: 6px; }
        .data-table .col-title { font-weight: 700; color: #192F59; }
        .data-table .col-sub { font-size: .76rem; color: #9ca3af; margin-top: .1rem; }
        .data-table .price { font-weight: 700; color: #00A553; }

        /* ── Status Badges ───────────────────────────────────────────── */
        .badge { display: inline-flex; align-items: center; gap: .28rem; padding: .26rem .65rem; border-radius: 20px; font-size: .7rem; font-weight: 800; text-transform: uppercase; letter-spacing: .3px; white-space: nowrap; }
        .badge-pending  { background: rgba(245,158,11,.12); color: #92400e; }
        .badge-approved { background: rgba(0,165,83,.12);   color: #065f35; }
        .badge-rejected { background: rgba(229,62,62,.1);   color: #7f1d1d; }
        .badge-archived { background: #f3f4f6; color: #6b7280; }
        .badge-verified { background: rgba(0,165,83,.12);   color: #065f35; }
        .badge-admin    { background: rgba(124,58,237,.12); color: #4c1d95; }
        .badge-student  { background: rgba(25,47,89,.1);    color: #1e3a5f; }
        .badge-landlord { background: rgba(245,158,11,.12); color: #6b4500; }

        /* ── Inline action buttons ───────────────────────────────────── */
        .btn { display: inline-flex; align-items: center; gap: .3rem; padding: .35rem .75rem; border-radius: 7px; font-size: .78rem; font-weight: 700; border: none; cursor: pointer; font-family: inherit; transition: all .15s; text-decoration: none; white-space: nowrap; }
        .btn-approve { background: rgba(0,165,83,.12); color: #065f35; }
        .btn-approve:hover { background: #00A553; color: #fff; }
        .btn-reject  { background: rgba(229,62,62,.09); color: #c0392b; }
        .btn-reject:hover  { background: rgba(229,62,62,.18); }
        .btn-view    { background: #eef1f5; color: #192F59; }
        .btn-view:hover    { background: #dce2ee; }
        .btn-primary { background: #192F59; color: #fff; }
        .btn-primary:hover { background: #0f1d3a; }
        .btn-green { background: #00A553; color: #fff; box-shadow: 0 2px 8px rgba(0,165,83,.3); }
        .btn-green:hover { background: #007f3f; }

        /* ── Filter tabs / search bar ────────────────────────────────── */
        .filter-row { display: flex; align-items: center; flex-wrap: wrap; gap: .75rem; margin-bottom: 1.2rem; }
        .filter-tabs { display: flex; gap: .35rem; }
        .filter-tab { padding: .42rem .9rem; border-radius: 7px; font-size: .8rem; font-weight: 700; text-decoration: none; color: #374151; border: 1.5px solid #e5e9f0; transition: all .15s; white-space: nowrap; }
        .filter-tab:hover { border-color: #00A553; color: #00A553; }
        .filter-tab.active { background: #00A553; color: #fff; border-color: #00A553; }
        .filter-search { display: flex; flex: 1; min-width: 200px; }
        .filter-search input { flex: 1; padding: .42rem .85rem; border: 1.5px solid #d4dae5; border-right: none; border-radius: 7px 0 0 7px; font-family: inherit; font-size: .85rem; outline: none; }
        .filter-search input:focus { border-color: #00A553; }
        .filter-search button { background: #192F59; color: #fff; border: none; padding: .42rem .9rem; border-radius: 0 7px 7px 0; font-size: .85rem; cursor: pointer; }

        /* ── Property thumbnail row ──────────────────────────────────── */
        .prop-cell { display: flex; align-items: center; gap: .75rem; }

        /* ── Empty state ─────────────────────────────────────────────── */
        .empty { text-align: center; padding: 3.5rem 2rem; }
        .empty .em-icon { font-size: 2.5rem; margin-bottom: .8rem; }
        .empty h3 { font-size: 1.05rem; font-weight: 700; color: #192F59; margin-bottom: .4rem; }
        .empty p { font-size: .85rem; color: #7a8ba3; }

        /* ── Pagination ──────────────────────────────────────────────── */
        .pagi { margin-top: 1rem; display: flex; justify-content: center; padding: 1rem; }

        /* ── Reject modal ────────────────────────────────────────────── */
        .modal-backdrop { position: fixed; inset: 0; background: rgba(0,0,0,.45); z-index: 900; display: none; align-items: center; justify-content: center; }
        .modal-backdrop.open { display: flex; }
        .modal { background: #fff; border-radius: 16px; width: 100%; max-width: 460px; padding: 2rem; box-shadow: 0 20px 60px rgba(0,0,0,.25); margin: 1rem; }
        .modal h3 { font-size: 1.05rem; font-weight: 700; color: #192F59; margin-bottom: .4rem; }
        .modal p { font-size: .85rem; color: #7a8ba3; margin-bottom: 1.2rem; }
        .modal textarea { width: 100%; padding: .7rem .85rem; border: 1.5px solid #d4dae5; border-radius: 8px; font-family: inherit; font-size: .9rem; resize: vertical; min-height: 90px; outline: none; box-sizing: border-box; }
        .modal textarea:focus { border-color: #e53e3e; }
        .modal-actions { display: flex; gap: .7rem; justify-content: flex-end; margin-top: 1.2rem; }
        .btn-cancel { background: #f3f4f6; color: #374151; }
        .btn-cancel:hover { background: #e5e7eb; }
        .btn-danger { background: #e53e3e; color: #fff; }
        .btn-danger:hover { background: #c0392b; }

        /* ── Responsive ──────────────────────────────────────────────── */
        @media (max-width: 1024px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 768px) {
            .admin-sidebar { position: fixed; left: -230px; top: 60px; height: calc(100vh - 60px); z-index: 150; }
            .admin-sidebar.open { left: 0; box-shadow: 4px 0 20px rgba(0,0,0,.2); }
            .topbar-hamburger { display: flex; }
            .admin-main { padding: 1.2rem; }
            .stats-grid { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 480px) {
            .stats-grid { grid-template-columns: 1fr; }
            .filter-row { flex-direction: column; align-items: stretch; }
        }
    </style>
</head>
<body>

<!-- ── Top Bar ────────────────────────────────────────────────────────── -->
<header class="admin-topbar">
    <button class="topbar-hamburger" id="hamburger" aria-label="Toggle sidebar">
        <span></span><span></span><span></span>
    </button>
    <a href="{{ route('home') }}" class="topbar-logo">
        <div class="topbar-logo-dot">B</div>
        <div class="topbar-logo-text">
            <strong>BOUESTI</strong>
            <span>Admin Panel</span>
        </div>
    </a>
    <div class="topbar-spacer"></div>
    <span class="topbar-admin-name">{{ auth()->user()->name }}</span>
    <span class="topbar-badge">Admin</span>
    <form method="POST" action="{{ route('logout') }}" style="display:inline">
        @csrf
        <button type="submit" class="topbar-logout">Sign Out</button>
    </form>
</header>

<div class="admin-shell">

    <!-- ── Sidebar ────────────────────────────────────────────────────── -->
    <aside class="admin-sidebar" id="sidebar">
        <div class="sidebar-label">Overview</div>
        <a href="{{ route('admin.dashboard') }}" class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="s-icon">📊</span> Dashboard
        </a>

        <div class="sidebar-divider"></div>
        <div class="sidebar-label">Property Management</div>
        <a href="{{ route('admin.properties', ['status'=>'pending']) }}" class="sidebar-item {{ request()->routeIs('admin.properties') && request('status') !== 'approved' && request('status') !== 'rejected' ? 'active' : '' }}">
            <span class="s-icon">⏳</span> Pending Listings
            @if($stats['pending'] > 0)
                <span class="sidebar-badge">{{ $stats['pending'] }}</span>
            @endif
        </a>
        <a href="{{ route('admin.properties', ['status'=>'approved']) }}" class="sidebar-item">
            <span class="s-icon">✅</span> Approved Listings
        </a>
        <a href="{{ route('admin.properties', ['status'=>'all']) }}" class="sidebar-item">
            <span class="s-icon">🏠</span> All Listings
        </a>

        <div class="sidebar-divider"></div>
        <div class="sidebar-label">User Management</div>
        <a href="{{ route('admin.landlords') }}" class="sidebar-item {{ request()->routeIs('admin.landlords') ? 'active' : '' }}">
            <span class="s-icon">🔑</span> Landlords
            @if($stats['pending_landlords'] > 0)
                <span class="sidebar-badge">{{ $stats['pending_landlords'] }}</span>
            @endif
        </a>
        <a href="{{ route('admin.users') }}" class="sidebar-item {{ request()->routeIs('admin.users') ? 'active' : '' }}">
            <span class="s-icon">👥</span> All Users
        </a>

        <div class="sidebar-divider"></div>
        <div class="sidebar-label">System</div>
        <a href="{{ route('home') }}" class="sidebar-item">
            <span class="s-icon">🌐</span> Public Site
        </a>
        <a href="{{ route('profile.edit') }}" class="sidebar-item">
            <span class="s-icon">👤</span> My Profile
        </a>
    </aside>

    <!-- ── Main ───────────────────────────────────────────────────────── -->
    <main class="admin-main">

        @if(session('success'))
            <div class="alert alert-success">✅ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">✕ {{ session('error') }}</div>
        @endif

        <!-- Page Header -->
        <div class="page-hdr">
            <div>
                <div class="page-hdr-title">📊 Admin Dashboard</div>
                <div class="page-hdr-sub">Overview — {{ now()->format('l, d F Y') }}</div>
            </div>
            <a href="{{ route('admin.properties', ['status'=>'pending']) }}" class="btn btn-green">
                ⏳ Review Pending ({{ $stats['pending'] }})
            </a>
        </div>

        <!-- Stat Cards (8 cards in 4-column grid) -->
        <div class="stats-grid">
            <div class="stat-card amber">
                <div class="stat-icon ic-a">⏳</div>
                <div>
                    <div class="stat-val">{{ $stats['pending'] }}</div>
                    <div class="stat-lbl">Pending Properties</div>
                </div>
            </div>
            <div class="stat-card green">
                <div class="stat-icon ic-g">✅</div>
                <div>
                    <div class="stat-val">{{ $stats['approved'] }}</div>
                    <div class="stat-lbl">Approved Listings</div>
                </div>
            </div>
            <div class="stat-card red">
                <div class="stat-icon ic-r">✕</div>
                <div>
                    <div class="stat-val">{{ $stats['rejected'] }}</div>
                    <div class="stat-lbl">Rejected Listings</div>
                </div>
            </div>
            <div class="stat-card navy">
                <div class="stat-icon ic-n">🏠</div>
                <div>
                    <div class="stat-val">{{ $stats['total_properties'] }}</div>
                    <div class="stat-lbl">Total Listings</div>
                </div>
            </div>
            <div class="stat-card navy">
                <div class="stat-icon ic-n">👥</div>
                <div>
                    <div class="stat-val">{{ $stats['total_users'] }}</div>
                    <div class="stat-lbl">Total Users</div>
                </div>
            </div>
            <div class="stat-card green">
                <div class="stat-icon ic-g">🎓</div>
                <div>
                    <div class="stat-val">{{ $stats['total_students'] }}</div>
                    <div class="stat-lbl">Students</div>
                </div>
            </div>
            <div class="stat-card amber">
                <div class="stat-icon ic-a">🔑</div>
                <div>
                    <div class="stat-val">{{ $stats['total_landlords'] }}</div>
                    <div class="stat-lbl">Landlords</div>
                </div>
            </div>
            <div class="stat-card red">
                <div class="stat-icon ic-r">🕐</div>
                <div>
                    <div class="stat-val">{{ $stats['pending_landlords'] }}</div>
                    <div class="stat-lbl">Unverified Landlords</div>
                </div>
            </div>
        </div>

        <!-- Pending Properties Table -->
        <div class="card">
            <div class="card-hdr">
                <h3>⏳ Pending Property Listings</h3>
                <div class="card-hdr-actions">
                    <a href="{{ route('admin.properties', ['status'=>'pending']) }}" class="btn btn-primary">View All →</a>
                </div>
            </div>
            <div class="tbl-wrap">
                @if($pendingProperties->isEmpty())
                    <div class="empty">
                        <div class="em-icon">🎉</div>
                        <h3>No Pending Properties</h3>
                        <p>All listings have been reviewed. Well done!</p>
                    </div>
                @else
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Property</th>
                                <th>Area</th>
                                <th>Type</th>
                                <th>Price / Year</th>
                                <th>Landlord</th>
                                <th>Submitted</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendingProperties as $p)
                            <tr>
                                <td>
                                    <div class="prop-cell">
                                        <img src="{{ $p->coverImageUrl() }}" alt="{{ $p->title }}" class="col-img">
                                        <div>
                                            <div class="col-title">{{ $p->title }}</div>
                                            <div class="col-sub">{{ Str::limit($p->address, 38) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $p->area }}</td>
                                <td>{{ $p->typeLabel() }}</td>
                                <td class="price">{{ $p->formattedPrice() }}</td>
                                <td>
                                    <div class="col-title" style="font-size:.85rem;">{{ $p->landlord->user->name ?? '—' }}</div>
                                    <div class="col-sub">{{ $p->landlord->user->email ?? '' }}</div>
                                </td>
                                <td style="color:#7a8ba3; font-size:.82rem; white-space:nowrap;">{{ $p->created_at->format('d M Y') }}</td>
                                <td>
                                    <div style="display:flex; gap:.4rem; flex-wrap:wrap;">
                                        <a href="{{ route('admin.properties.detail', $p) }}" class="btn btn-view">View</a>
                                        <form method="POST" action="{{ route('admin.properties.approve', $p) }}" style="display:inline" onsubmit="return confirm('Approve this property?');">
                                            @csrf
                                            <button type="submit" class="btn btn-approve">✓ Approve</button>
                                        </form>
                                        <button type="button" class="btn btn-reject" onclick="openRejectModal({{ $p->id }}, '{{ addslashes($p->title) }}')">✕ Reject</button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

    </main>
</div>

<!-- ── Reject Modal ────────────────────────────────────────────────── -->
<div class="modal-backdrop" id="rejectModal">
    <div class="modal">
        <h3>✕ Reject Property Listing</h3>
        <p id="rejectModalDesc">Provide an optional reason for rejection. The landlord may see this.</p>
        <form id="rejectForm" method="POST">
            @csrf
            <textarea name="rejection_reason" placeholder="Reason for rejection (optional)…" id="rejectReason"></textarea>
            <div class="modal-actions">
                <button type="button" class="btn btn-cancel" onclick="closeRejectModal()">Cancel</button>
                <button type="submit" class="btn btn-danger">✕ Confirm Rejection</button>
            </div>
        </form>
    </div>
</div>

<script>
// ── Sidebar toggle ─────────────────────────────────────────────────
const hamburger = document.getElementById('hamburger');
const sidebar   = document.getElementById('sidebar');
hamburger.addEventListener('click', () => sidebar.classList.toggle('open'));
document.addEventListener('click', (e) => {
    if (!sidebar.contains(e.target) && !hamburger.contains(e.target)) {
        sidebar.classList.remove('open');
    }
});

// ── Reject Modal ───────────────────────────────────────────────────
const rejectModal = document.getElementById('rejectModal');
const rejectForm  = document.getElementById('rejectForm');
const rejectDesc  = document.getElementById('rejectModalDesc');

function openRejectModal(propertyId, propertyTitle) {
    rejectForm.action = `/admin/properties/${propertyId}/reject`;
    rejectDesc.textContent = `Rejecting: "${propertyTitle}"`;
    document.getElementById('rejectReason').value = '';
    rejectModal.classList.add('open');
}
function closeRejectModal() {
    rejectModal.classList.remove('open');
}
rejectModal.addEventListener('click', (e) => {
    if (e.target === rejectModal) closeRejectModal();
});
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeRejectModal();
});
</script>
</body>
</html>
