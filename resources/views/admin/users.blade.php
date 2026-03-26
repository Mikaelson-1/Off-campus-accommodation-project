<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users — Admin | BOUESTI</title>
    @vite(['resources/css/app.css', 'resources/css/bouesti.css', 'resources/js/app.js'])
    <style>
        *, *::before, *::after { box-sizing: border-box; }
        body { font-family:'Inter',sans-serif;margin:0;background:#f0f2f5; }
        .admin-topbar { position:sticky;top:0;z-index:200;background:linear-gradient(90deg,#0d1b34,#192F59);height:60px;display:flex;align-items:center;padding:0 1.5rem;gap:1rem;box-shadow:0 2px 16px rgba(0,0,0,.3); }
        .topbar-hamburger { display:none;flex-direction:column;gap:5px;cursor:pointer;background:none;border:none;padding:.3rem; }
        .topbar-hamburger span { display:block;width:22px;height:2px;background:rgba(255,255,255,.7);border-radius:2px; }
        .topbar-logo { display:flex;align-items:center;gap:.65rem;text-decoration:none; }
        .topbar-logo-dot { width:34px;height:34px;background:linear-gradient(135deg,#00A553,#007f3f);border-radius:8px;display:flex;align-items:center;justify-content:center;font-weight:900;color:#fff;font-size:.85rem; }
        .topbar-logo-text strong { display:block;font-size:.9rem;font-weight:800;color:#fff; }
        .topbar-logo-text span { font-size:.65rem;color:rgba(255,255,255,.45);text-transform:uppercase;letter-spacing:.5px; }
        .topbar-spacer { flex:1; }
        .topbar-admin-name { font-size:.82rem;color:rgba(255,255,255,.65); }
        .topbar-badge { padding:.22rem .6rem;border-radius:20px;font-size:.68rem;font-weight:800;letter-spacing:.4px;text-transform:uppercase;background:rgba(229,62,62,.25);color:#ff6b6b; }
        .topbar-logout { background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.2);color:rgba(255,255,255,.75);padding:.38rem .9rem;border-radius:7px;font-size:.8rem;font-weight:600;cursor:pointer;font-family:inherit;transition:all .2s; }
        .admin-shell { display:flex;min-height:calc(100vh - 60px); }
        .admin-sidebar { width:230px;flex-shrink:0;background:#fff;border-right:1px solid #e5e9f0;padding:1.2rem .8rem;display:flex;flex-direction:column;transition:transform .25s;overflow-y:auto; }
        .sidebar-label { font-size:.67rem;font-weight:800;text-transform:uppercase;letter-spacing:.8px;color:#b0b8c8;padding:.6rem .7rem .25rem;margin-top:.4rem; }
        .sidebar-item { display:flex;align-items:center;gap:.65rem;padding:.58rem .8rem;border-radius:9px;text-decoration:none;font-size:.86rem;font-weight:500;color:#374151;transition:all .15s;position:relative; }
        .sidebar-item:hover { background:#f0f2f5;color:#192F59; }
        .sidebar-item.active { background:rgba(0,165,83,.1);color:#00A553;font-weight:700; }
        .sidebar-item.active::before { content:'';position:absolute;left:0;top:25%;height:50%;width:3px;background:#00A553;border-radius:0 3px 3px 0; }
        .sidebar-item .s-icon { width:20px;text-align:center;font-size:1rem; }
        .sidebar-divider { height:1px;background:#eef1f5;margin:.6rem 0; }
        .admin-main { flex:1;padding:1.8rem;overflow-x:hidden; }
        .page-hdr { display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:1rem;margin-bottom:1.8rem; }
        .page-hdr-title { font-size:1.3rem;font-weight:800;color:#192F59;margin-bottom:.2rem; }
        .page-hdr-sub { font-size:.85rem;color:#7a8ba3; }
        .card { background:#fff;border-radius:14px;box-shadow:0 2px 12px rgba(25,47,89,.07);margin-bottom:1.5rem;overflow:hidden; }
        .card-hdr { padding:1rem 1.4rem;border-bottom:1px solid #f0f2f5;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.75rem; }
        .card-hdr h3 { font-size:.95rem;font-weight:700;color:#192F59; }
        .tbl-wrap { overflow-x:auto; }
        .data-table { width:100%;border-collapse:collapse;font-size:.86rem; }
        .data-table thead th { background:#f8fafc;padding:.7rem 1rem;text-align:left;font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#7a8ba3;border-bottom:2px solid #eef1f5;white-space:nowrap; }
        .data-table tbody td { padding:.85rem 1rem;border-bottom:1px solid #f3f4f6;vertical-align:middle; }
        .data-table tbody tr:last-child td { border-bottom:none; }
        .data-table tbody tr:hover td { background:#fafbfc; }
        .col-title { font-weight:700;color:#192F59; }
        .col-sub { font-size:.76rem;color:#9ca3af;margin-top:.1rem; }
        .avatar { width:36px;height:36px;border-radius:50%;background:#eef1f5;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:.85rem;color:#192F59;flex-shrink:0;text-transform:uppercase; }
        .user-cell { display:flex;align-items:center;gap:.75rem; }
        .badge { display:inline-flex;align-items:center;gap:.28rem;padding:.26rem .65rem;border-radius:20px;font-size:.7rem;font-weight:800;text-transform:uppercase;letter-spacing:.3px; }
        .badge-admin    { background:rgba(124,58,237,.12);color:#4c1d95; }
        .badge-student  { background:rgba(25,47,89,.1);color:#1e3a5f; }
        .badge-landlord { background:rgba(245,158,11,.12);color:#6b4500; }
        .filter-row { display:flex;align-items:center;flex-wrap:wrap;gap:.75rem;margin-bottom:1.2rem; }
        .filter-tabs { display:flex;gap:.35rem;flex-wrap:wrap; }
        .filter-tab { padding:.42rem .9rem;border-radius:7px;font-size:.8rem;font-weight:700;text-decoration:none;color:#374151;border:1.5px solid #e5e9f0;transition:all .15s;white-space:nowrap; }
        .filter-tab:hover { border-color:#00A553;color:#00A553; }
        .filter-tab.active { background:#00A553;color:#fff;border-color:#00A553; }
        .filter-search { display:flex;flex:1;min-width:200px; }
        .filter-search input { flex:1;padding:.42rem .85rem;border:1.5px solid #d4dae5;border-right:none;border-radius:7px 0 0 7px;font-family:inherit;font-size:.85rem;outline:none; }
        .filter-search input:focus { border-color:#00A553; }
        .filter-search button { background:#192F59;color:#fff;border:none;padding:.42rem .9rem;border-radius:0 7px 7px 0;font-size:.85rem;cursor:pointer; }
        .empty { text-align:center;padding:3.5rem 2rem; }
        .empty .em-icon { font-size:2.5rem;margin-bottom:.8rem; }
        .empty h3 { font-size:1.05rem;font-weight:700;color:#192F59;margin-bottom:.4rem; }
        .pagi { margin-top:1rem;display:flex;justify-content:center;padding:1rem; }
        @media (max-width:768px) {
            .admin-sidebar { position:fixed;left:-230px;top:60px;height:calc(100vh - 60px);z-index:150; }
            .admin-sidebar.open { left:0;box-shadow:4px 0 20px rgba(0,0,0,.2); }
            .topbar-hamburger { display:flex; }
            .admin-main { padding:1.2rem; }
        }
    </style>
</head>
<body>
<header class="admin-topbar">
    <button class="topbar-hamburger" id="hamburger"><span></span><span></span><span></span></button>
    <a href="{{ route('home') }}" class="topbar-logo">
        <div class="topbar-logo-dot">B</div>
        <div class="topbar-logo-text"><strong>BOUESTI</strong><span>Admin Panel</span></div>
    </a>
    <div class="topbar-spacer"></div>
    <span class="topbar-admin-name">{{ auth()->user()->name }}</span>
    <span class="topbar-badge">Admin</span>
    <form method="POST" action="{{ route('logout') }}" style="display:inline">@csrf
        <button type="submit" class="topbar-logout">Sign Out</button>
    </form>
</header>

<div class="admin-shell">
    <aside class="admin-sidebar" id="sidebar">
        <div class="sidebar-label">Overview</div>
        <a href="{{ route('admin.dashboard') }}" class="sidebar-item"><span class="s-icon">📊</span> Dashboard</a>
        <div class="sidebar-divider"></div>
        <div class="sidebar-label">Property Management</div>
        <a href="{{ route('admin.properties', ['status'=>'pending']) }}" class="sidebar-item"><span class="s-icon">⏳</span> Pending Listings</a>
        <a href="{{ route('admin.properties', ['status'=>'all']) }}" class="sidebar-item"><span class="s-icon">🏠</span> All Listings</a>
        <div class="sidebar-divider"></div>
        <div class="sidebar-label">User Management</div>
        <a href="{{ route('admin.landlords') }}" class="sidebar-item"><span class="s-icon">🔑</span> Landlords</a>
        <a href="{{ route('admin.users') }}" class="sidebar-item active"><span class="s-icon">👥</span> All Users</a>
        <div class="sidebar-divider"></div>
        <a href="{{ route('home') }}" class="sidebar-item"><span class="s-icon">🌐</span> Public Site</a>
    </aside>

    <main class="admin-main">
        <div class="page-hdr">
            <div>
                <div class="page-hdr-title">👥 All Users</div>
                <div class="page-hdr-sub">{{ $users->total() }} registered user(s)</div>
            </div>
        </div>

        <div class="filter-row">
            <div class="filter-tabs">
                @foreach(['all'=>'All','admin'=>'👮 Admin','student'=>'🎓 Students','landlord'=>'🔑 Landlords'] as $val=>$label)
                    <a href="{{ route('admin.users', ['role'=>$val, 'q'=>$search]) }}"
                       class="filter-tab {{ $role === $val ? 'active' : '' }}">{{ $label }}</a>
                @endforeach
            </div>
            <form class="filter-search" method="GET" action="{{ route('admin.users') }}">
                <input type="hidden" name="role" value="{{ $role }}">
                <input type="text" name="q" value="{{ $search }}" placeholder="Search name or email…">
                <button type="submit">🔍</button>
            </form>
        </div>

        <div class="card">
            <div class="card-hdr">
                <h3>👥 Users <span style="font-size:.78rem;font-weight:500;color:#9ca3af;">— {{ $users->total() }} total</span></h3>
            </div>
            <div class="tbl-wrap">
                @if($users->isEmpty())
                    <div class="empty">
                        <div class="em-icon">🔍</div>
                        <h3>No Users Found</h3>
                        <p>No users match your current filter or search.</p>
                    </div>
                @else
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Extra Info</th>
                            <th>Joined</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $u)
                        <tr>
                            <td style="color:#9ca3af;font-size:.78rem;">{{ $loop->iteration + ($users->currentPage()-1)*$users->perPage() }}</td>
                            <td>
                                <div class="user-cell">
                                    <div class="avatar">{{ substr($u->name, 0, 2) }}</div>
                                    <div>
                                        <div class="col-title">{{ $u->name }}</div>
                                        <div class="col-sub">{{ $u->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td style="font-size:.85rem;color:#374151;">{{ $u->phone ?? '—' }}</td>
                            <td>
                                <span class="badge badge-{{ $u->role }}">
                                    @if($u->role==='admin') 👮 @elseif($u->role==='student') 🎓 @else 🔑 @endif
                                    {{ ucfirst($u->role) }}
                                </span>
                            </td>
                            <td style="font-size:.83rem;color:#374151;">
                                @if($u->role === 'student' && $u->student)
                                    Matric: {{ $u->student->matriculation_number }}
                                @elseif($u->role === 'landlord' && $u->landlord)
                                    <span class="badge {{ $u->landlord->verification_status === 'verified' ? 'badge-approved' : ($u->landlord->verification_status === 'rejected' ? 'badge-rejected' : 'badge-pending') }}" style="font-size:.66rem;">
                                        {{ ucfirst($u->landlord->verification_status) }}
                                    </span>
                                    · {{ $u->landlord->properties()->count() }} listing(s)
                                @else —
                                @endif
                            </td>
                            <td style="color:#7a8ba3;font-size:.8rem;white-space:nowrap;">{{ $u->created_at->format('d M Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
            @if($users->hasPages())
            <div class="pagi">{{ $users->withQueryString()->links() }}</div>
            @endif
        </div>
    </main>
</div>

<script>
const hamburger = document.getElementById('hamburger');
const sidebar   = document.getElementById('sidebar');
hamburger.addEventListener('click', () => sidebar.classList.toggle('open'));
document.addEventListener('click', e => { if (!sidebar.contains(e.target) && !hamburger.contains(e.target)) sidebar.classList.remove('open'); });
</script>
</body>
</html>
