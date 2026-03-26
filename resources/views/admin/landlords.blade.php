<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landlord Management — Admin | BOUESTI</title>
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
        .topbar-logout:hover { background:rgba(255,255,255,.18);color:#fff; }
        .admin-shell { display:flex;min-height:calc(100vh - 60px); }
        .admin-sidebar { width:230px;flex-shrink:0;background:#fff;border-right:1px solid #e5e9f0;padding:1.2rem .8rem;display:flex;flex-direction:column;transition:transform .25s;overflow-y:auto; }
        .sidebar-label { font-size:.67rem;font-weight:800;text-transform:uppercase;letter-spacing:.8px;color:#b0b8c8;padding:.6rem .7rem .25rem;margin-top:.4rem; }
        .sidebar-item { display:flex;align-items:center;gap:.65rem;padding:.58rem .8rem;border-radius:9px;text-decoration:none;font-size:.86rem;font-weight:500;color:#374151;transition:all .15s;position:relative; }
        .sidebar-item:hover { background:#f0f2f5;color:#192F59; }
        .sidebar-item.active { background:rgba(0,165,83,.1);color:#00A553;font-weight:700; }
        .sidebar-item.active::before { content:'';position:absolute;left:0;top:25%;height:50%;width:3px;background:#00A553;border-radius:0 3px 3px 0; }
        .sidebar-item .s-icon { width:20px;text-align:center;font-size:1rem; }
        .sidebar-badge { margin-left:auto;background:#e53e3e;color:#fff;font-size:.66rem;font-weight:800;padding:.18rem .45rem;border-radius:10px;min-width:20px;text-align:center; }
        .sidebar-divider { height:1px;background:#eef1f5;margin:.6rem 0; }
        .admin-main { flex:1;padding:1.8rem;overflow-x:hidden; }
        .page-hdr { display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:1rem;margin-bottom:1.8rem; }
        .page-hdr-title { font-size:1.3rem;font-weight:800;color:#192F59;margin-bottom:.2rem; }
        .page-hdr-sub { font-size:.85rem;color:#7a8ba3; }
        .alert { padding:.85rem 1.1rem;border-radius:10px;font-size:.87rem;margin-bottom:1.4rem;display:flex;align-items:flex-start;gap:.5rem;line-height:1.5; }
        .alert-success { background:rgba(0,165,83,.09);border:1px solid rgba(0,165,83,.3);color:#065f35; }
        .card { background:#fff;border-radius:14px;box-shadow:0 2px 12px rgba(25,47,89,.07);margin-bottom:1.5rem;overflow:hidden; }
        .card-hdr { padding:1rem 1.4rem;border-bottom:1px solid #f0f2f5;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.75rem; }
        .card-hdr h3 { font-size:.95rem;font-weight:700;color:#192F59;display:flex;align-items:center;gap:.45rem; }
        .tbl-wrap { overflow-x:auto; }
        .data-table { width:100%;border-collapse:collapse;font-size:.86rem; }
        .data-table thead th { background:#f8fafc;padding:.7rem 1rem;text-align:left;font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#7a8ba3;border-bottom:2px solid #eef1f5;white-space:nowrap; }
        .data-table tbody td { padding:.85rem 1rem;border-bottom:1px solid #f3f4f6;vertical-align:middle; }
        .data-table tbody tr:last-child td { border-bottom:none; }
        .data-table tbody tr:hover td { background:#fafbfc; }
        .col-title { font-weight:700;color:#192F59; }
        .col-sub { font-size:.76rem;color:#9ca3af;margin-top:.1rem; }
        .badge { display:inline-flex;align-items:center;gap:.28rem;padding:.26rem .65rem;border-radius:20px;font-size:.7rem;font-weight:800;text-transform:uppercase;letter-spacing:.3px;white-space:nowrap; }
        .badge-pending  { background:rgba(245,158,11,.12);color:#92400e; }
        .badge-verified { background:rgba(0,165,83,.12);color:#065f35; }
        .badge-rejected { background:rgba(229,62,62,.1);color:#7f1d1d; }
        .btn { display:inline-flex;align-items:center;gap:.3rem;padding:.35rem .75rem;border-radius:7px;font-size:.78rem;font-weight:700;border:none;cursor:pointer;font-family:inherit;transition:all .15s;text-decoration:none;white-space:nowrap; }
        .btn-verify { background:rgba(0,165,83,.12);color:#065f35; }
        .btn-verify:hover { background:#00A553;color:#fff; }
        .btn-reject { background:rgba(229,62,62,.09);color:#c0392b; }
        .btn-reject:hover { background:rgba(229,62,62,.18); }
        .btn-view   { background:#eef1f5;color:#192F59; }
        .btn-view:hover { background:#dce2ee; }
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
        .empty p { font-size:.85rem;color:#7a8ba3; }
        .pagi { margin-top:1rem;display:flex;justify-content:center;padding:1rem; }
        /* modal */
        .modal-backdrop { position:fixed;inset:0;background:rgba(0,0,0,.45);z-index:900;display:none;align-items:center;justify-content:center; }
        .modal-backdrop.open { display:flex; }
        .modal { background:#fff;border-radius:16px;width:100%;max-width:460px;padding:2rem;box-shadow:0 20px 60px rgba(0,0,0,.25);margin:1rem; }
        .modal h3 { font-size:1.05rem;font-weight:700;color:#192F59;margin-bottom:.4rem; }
        .modal p { font-size:.85rem;color:#7a8ba3;margin-bottom:1.2rem; }
        .modal textarea { width:100%;padding:.7rem .85rem;border:1.5px solid #d4dae5;border-radius:8px;font-family:inherit;font-size:.9rem;resize:vertical;min-height:90px;outline:none;box-sizing:border-box; }
        .modal-actions { display:flex;gap:.7rem;justify-content:flex-end;margin-top:1.2rem; }
        .btn-cancel { background:#f3f4f6;color:#374151; }
        .btn-danger { background:#e53e3e;color:#fff; }
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
        <a href="{{ route('admin.landlords') }}" class="sidebar-item active"><span class="s-icon">🔑</span> Landlords
            @if($counts['pending'] > 0)<span class="sidebar-badge">{{ $counts['pending'] }}</span>@endif
        </a>
        <a href="{{ route('admin.users') }}" class="sidebar-item"><span class="s-icon">👥</span> All Users</a>
        <div class="sidebar-divider"></div>
        <a href="{{ route('home') }}" class="sidebar-item"><span class="s-icon">🌐</span> Public Site</a>
    </aside>

    <main class="admin-main">
        @if(session('success'))<div class="alert alert-success">✅ {{ session('success') }}</div>@endif

        <div class="page-hdr">
            <div>
                <div class="page-hdr-title">🔑 Landlord Management</div>
                <div class="page-hdr-sub">{{ $landlords->total() }} landlord(s) found</div>
            </div>
        </div>

        <div class="filter-row">
            <div class="filter-tabs">
                @foreach(['pending'=>'⏳ Pending','verified'=>'✅ Verified','rejected'=>'✕ Rejected','all'=>'All'] as $val=>$label)
                    <a href="{{ route('admin.landlords', ['status'=>$val, 'q'=>$search]) }}"
                       class="filter-tab {{ $status === $val ? 'active' : '' }}">
                        {{ $label }} ({{ $counts[$val] ?? 0 }})
                    </a>
                @endforeach
            </div>
            <form class="filter-search" method="GET" action="{{ route('admin.landlords') }}">
                <input type="hidden" name="status" value="{{ $status }}">
                <input type="text" name="q" value="{{ $search }}" placeholder="Search by name or email…">
                <button type="submit">🔍</button>
            </form>
        </div>

        <div class="card">
            <div class="card-hdr">
                <h3>🔑 Landlords <span style="font-size:.78rem;font-weight:500;color:#9ca3af;">— {{ $landlords->total() }} total</span></h3>
            </div>
            <div class="tbl-wrap">
                @if($landlords->isEmpty())
                    <div class="empty">
                        <div class="em-icon">🎉</div>
                        <h3>No Landlords Found</h3>
                        <p>No landlord accounts match the current filter.</p>
                    </div>
                @else
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Landlord</th>
                            <th>Phone</th>
                            <th>Properties</th>
                            <th>Joined</th>
                            <th>Verification Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($landlords as $landlord)
                        <tr>
                            <td style="color:#9ca3af;font-size:.78rem;">{{ $loop->iteration + ($landlords->currentPage()-1)*$landlords->perPage() }}</td>
                            <td>
                                <div class="col-title">{{ $landlord->user->name ?? '—' }}</div>
                                <div class="col-sub">{{ $landlord->user->email ?? '—' }}</div>
                            </td>
                            <td style="font-size:.85rem;color:#374151;">{{ $landlord->user->phone ?? '—' }}</td>
                            <td style="font-size:.85rem;font-weight:700;color:#192F59;text-align:center;">{{ $landlord->properties()->count() }}</td>
                            <td style="color:#7a8ba3;font-size:.8rem;white-space:nowrap;">{{ $landlord->created_at->format('d M Y') }}</td>
                            <td>
                                <span class="badge badge-{{ $landlord->verification_status }}">
                                    @if($landlord->verification_status==='pending') ⏳
                                    @elseif($landlord->verification_status==='verified') ✅
                                    @else ✕ @endif
                                    {{ ucfirst($landlord->verification_status) }}
                                </span>
                            </td>
                            <td>
                                <div style="display:flex;gap:.35rem;flex-wrap:wrap;">
                                    @if($landlord->verification_status !== 'verified')
                                    <form method="POST" action="{{ route('admin.landlords.verify', $landlord) }}" style="display:inline"
                                        onsubmit="return confirm('Verify {{ addslashes($landlord->user->name ?? '') }}?');">
                                        @csrf
                                        <button type="submit" class="btn btn-verify">✓ Verify</button>
                                    </form>
                                    @endif
                                    @if($landlord->verification_status !== 'rejected')
                                    <button class="btn btn-reject"
                                        onclick="openRejectLandlord({{ $landlord->id }}, '{{ addslashes($landlord->user->name ?? '') }}')">
                                        ✕ Reject
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
            @if($landlords->hasPages())
            <div class="pagi">{{ $landlords->withQueryString()->links() }}</div>
            @endif
        </div>
    </main>
</div>

<!-- Reject Landlord Modal -->
<div class="modal-backdrop" id="rejectLandlordModal">
    <div class="modal">
        <h3>✕ Reject Landlord Account</h3>
        <p id="rejectLandlordDesc">Provide a reason (optional). The landlord will see this.</p>
        <form id="rejectLandlordForm" method="POST">
            @csrf
            <textarea name="rejection_reason" id="rejectLandlordReason" placeholder="Reason for rejection…"></textarea>
            <div class="modal-actions">
                <button type="button" class="btn btn-cancel" onclick="closeLandlordModal()">Cancel</button>
                <button type="submit" class="btn btn-danger">✕ Reject Account</button>
            </div>
        </form>
    </div>
</div>

<script>
const hamburger = document.getElementById('hamburger');
const sidebar   = document.getElementById('sidebar');
hamburger.addEventListener('click', () => sidebar.classList.toggle('open'));
document.addEventListener('click', e => { if (!sidebar.contains(e.target) && !hamburger.contains(e.target)) sidebar.classList.remove('open'); });

const landlordModal = document.getElementById('rejectLandlordModal');
function openRejectLandlord(id, name) {
    document.getElementById('rejectLandlordForm').action = `/admin/landlords/${id}/reject`;
    document.getElementById('rejectLandlordDesc').textContent = `Rejecting landlord account: "${name}"`;
    document.getElementById('rejectLandlordReason').value = '';
    landlordModal.classList.add('open');
}
function closeLandlordModal() { landlordModal.classList.remove('open'); }
landlordModal.addEventListener('click', e => { if (e.target === landlordModal) closeLandlordModal(); });
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLandlordModal(); });
</script>
</body>
</html>
