<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $property->title }} — Admin Review | BOUESTI</title>
    @vite(['resources/css/app.css', 'resources/css/bouesti.css', 'resources/js/app.js'])
    <style>
        *, *::before, *::after { box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; margin: 0; background: #f0f2f5; }
        /* Minimal admin nav */
        .admin-topbar { position:sticky;top:0;z-index:100;background:linear-gradient(90deg,#0d1b34,#192F59);height:60px;display:flex;align-items:center;padding:0 1.5rem;gap:1rem;box-shadow:0 2px 16px rgba(0,0,0,.3); }
        .topbar-logo { display:flex;align-items:center;gap:.65rem;text-decoration:none; }
        .topbar-logo-dot { width:34px;height:34px;background:linear-gradient(135deg,#00A553,#007f3f);border-radius:8px;display:flex;align-items:center;justify-content:center;font-weight:900;color:#fff;font-size:.85rem; }
        .topbar-logo-text strong { display:block;font-size:.9rem;font-weight:800;color:#fff; }
        .topbar-logo-text span { font-size:.65rem;color:rgba(255,255,255,.45);text-transform:uppercase;letter-spacing:.5px; }
        .topbar-spacer { flex:1; }
        .topbar-badge { padding:.22rem .6rem;border-radius:20px;font-size:.68rem;font-weight:800;letter-spacing:.4px;text-transform:uppercase;background:rgba(229,62,62,.25);color:#ff6b6b; }
        .nav-back { color:rgba(255,255,255,.7);text-decoration:none;font-size:.85rem;padding:.38rem .8rem;border-radius:7px;transition:all .2s; }
        .nav-back:hover { background:rgba(255,255,255,.1);color:#fff; }

        .page { max-width: 1050px; margin: 2rem auto; padding: 0 1.5rem 4rem; }
        .breadcrumb { display:flex;align-items:center;gap:.5rem;font-size:.8rem;color:#9ca3af;margin-bottom:1rem; }
        .breadcrumb a { color:#00A553;text-decoration:none; } .breadcrumb a:hover { text-decoration:underline; }

        /* Hero */
        .prop-hero { border-radius:16px;overflow:hidden;height:360px;position:relative;margin-bottom:1.8rem; }
        .prop-hero img { width:100%;height:100%;object-fit:cover; }
        .prop-hero-overlay { position:absolute;inset:0;background:linear-gradient(to top, rgba(25,47,89,.85) 0%, transparent 55%);display:flex;align-items:flex-end;padding:1.5rem 2rem; }
        .hero-title { color:#fff;font-size:1.5rem;font-weight:800;margin-bottom:.5rem; }

        /* Layout */
        .detail-layout { display:grid;grid-template-columns:1fr 300px;gap:1.5rem; }
        .card { background:#fff;border-radius:14px;box-shadow:0 2px 12px rgba(25,47,89,.08);margin-bottom:1.5rem;overflow:hidden; }
        .card-hdr { padding:1rem 1.4rem;border-bottom:1px solid #f0f2f5;font-size:.95rem;font-weight:700;color:#192F59;display:flex;align-items:center;gap:.45rem; }
        .card-body { padding:1.4rem; }

        /* Info rows */
        .info-row { display:flex;align-items:flex-start;gap:.6rem;padding:.6rem 0;border-bottom:1px solid #f7f8fa;font-size:.88rem;color:#374151; }
        .info-row:last-child { border-bottom:none; }
        .info-label { font-weight:700;color:#9ca3af;min-width:150px;flex-shrink:0;font-size:.77rem;text-transform:uppercase;letter-spacing:.3px; }

        /* Amenities */
        .amenity-list { display:flex;flex-wrap:wrap;gap:.5rem; }
        .amenity-chip { background:#eef1f5;color:#374151;font-size:.8rem;font-weight:600;padding:.3rem .75rem;border-radius:20px; }

        /* Status badge */
        .badge { display:inline-flex;align-items:center;gap:.28rem;padding:.3rem .8rem;border-radius:20px;font-size:.75rem;font-weight:800;text-transform:uppercase; }
        .badge-pending  { background:rgba(245,158,11,.12);color:#92400e; }
        .badge-approved { background:rgba(0,165,83,.12);color:#065f35; }
        .badge-rejected { background:rgba(229,62,62,.1);color:#7f1d1d; }

        /* Gallery */
        .gallery { display:grid;grid-template-columns:repeat(3,1fr);gap:.6rem; }
        .gallery img { width:100%;height:90px;object-fit:cover;border-radius:8px; }

        /* Action sidebar */
        .action-sidebar { position:sticky;top:80px; }
        .action-card { background:#fff;border-radius:14px;box-shadow:0 2px 12px rgba(25,47,89,.08);overflow:hidden;margin-bottom:1rem; }
        .ac-hdr { padding:1rem 1.2rem;background:#f8fafc;border-bottom:1px solid #f0f2f5;font-size:.85rem;font-weight:700;color:#192F59; }
        .ac-body { padding:1.2rem; }

        .action-btn { display:flex;align-items:center;justify-content:center;gap:.5rem;width:100%;padding:.8rem;border-radius:10px;font-size:.9rem;font-weight:700;border:none;cursor:pointer;font-family:inherit;margin-bottom:.7rem;transition:all .2s;text-decoration:none;box-sizing:border-box; }
        .action-btn:last-child { margin-bottom:0; }
        .ab-approve { background:linear-gradient(135deg,#00A553,#007f3f);color:#fff;box-shadow:0 3px 10px rgba(0,165,83,.3); }
        .ab-approve:hover { transform:translateY(-1px);box-shadow:0 5px 16px rgba(0,165,83,.4); }
        .ab-reject  { background:rgba(229,62,62,.1);color:#c0392b; }
        .ab-reject:hover { background:rgba(229,62,62,.18); }
        .ab-back    { background:#eef1f5;color:#192F59; }
        .ab-back:hover { background:#dce2ee; }

        .ac-note { font-size:.76rem;color:#9ca3af;line-height:1.5;text-align:center;margin-top:.7rem; }

        /* Alert */
        .alert { padding:.85rem 1.1rem;border-radius:10px;font-size:.87rem;margin-bottom:1.4rem;display:flex;align-items:flex-start;gap:.5rem;line-height:1.5; }
        .alert-success { background:rgba(0,165,83,.09);border:1px solid rgba(0,165,83,.3);color:#065f35; }

        /* Reject modal */
        .modal-backdrop { position:fixed;inset:0;background:rgba(0,0,0,.45);z-index:900;display:none;align-items:center;justify-content:center; }
        .modal-backdrop.open { display:flex; }
        .modal { background:#fff;border-radius:16px;width:100%;max-width:460px;padding:2rem;box-shadow:0 20px 60px rgba(0,0,0,.25);margin:1rem; }
        .modal h3 { font-size:1.05rem;font-weight:700;color:#192F59;margin-bottom:.4rem; }
        .modal p { font-size:.85rem;color:#7a8ba3;margin-bottom:1.2rem; }
        .modal textarea { width:100%;padding:.7rem .85rem;border:1.5px solid #d4dae5;border-radius:8px;font-family:inherit;font-size:.9rem;resize:vertical;min-height:90px;outline:none;box-sizing:border-box; }
        .modal textarea:focus { border-color:#e53e3e; }
        .modal-actions { display:flex;gap:.7rem;justify-content:flex-end;margin-top:1.2rem; }
        .btn { display:inline-flex;align-items:center;gap:.3rem;padding:.38rem .8rem;border-radius:7px;font-size:.82rem;font-weight:700;border:none;cursor:pointer;font-family:inherit;transition:all .15s; }
        .btn-cancel { background:#f3f4f6;color:#374151; }
        .btn-cancel:hover { background:#e5e7eb; }
        .btn-danger { background:#e53e3e;color:#fff; }
        .btn-danger:hover { background:#c0392b; }

        @media (max-width:768px) { .detail-layout { grid-template-columns:1fr; } .action-sidebar { position:static; } .prop-hero { height:220px; } }
    </style>
</head>
<body>
<header class="admin-topbar">
    <a href="{{ route('home') }}" class="topbar-logo">
        <div class="topbar-logo-dot">B</div>
        <div class="topbar-logo-text"><strong>BOUESTI</strong><span>Admin Panel</span></div>
    </a>
    <div class="topbar-spacer"></div>
    <span class="topbar-badge">Admin</span>
    <a href="{{ route('admin.properties', ['status'=>'pending']) }}" class="nav-back">← Back to Listings</a>
</header>

<div class="page">
    <div class="breadcrumb">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a> <span>›</span>
        <a href="{{ route('admin.properties', ['status'=>'pending']) }}">Listings</a> <span>›</span>
        <span>{{ $property->title }}</span>
    </div>

    @if(session('success'))<div class="alert alert-success">✅ {{ session('success') }}</div>@endif

    <!-- Hero -->
    <div class="prop-hero">
        <img src="{{ $property->coverImageUrl() }}" alt="{{ $property->title }}">
        <div class="prop-hero-overlay">
            <div>
                <div class="hero-title">{{ $property->title }}</div>
                <span class="badge badge-{{ $property->status }}">{{ $property->statusLabel() }}</span>
            </div>
        </div>
    </div>

    <div class="detail-layout">
        <!-- Left: Details -->
        <div>
            <div class="card">
                <div class="card-hdr">📋 Property Details</div>
                <div class="card-body">
                    <div class="info-row"><span class="info-label">Address</span>{{ $property->address }}</div>
                    <div class="info-row"><span class="info-label">Area</span>{{ $property->area }}, {{ $property->city }}, {{ $property->state }}</div>
                    <div class="info-row"><span class="info-label">Distance</span>{{ $property->distance_from_campus ?? '—' }} from BOUESTI</div>
                    <div class="info-row"><span class="info-label">Type</span>{{ $property->typeLabel() }}</div>
                    <div class="info-row"><span class="info-label">Price / Year</span><strong style="color:#00A553;font-size:1rem;">{{ $property->formattedPrice() }}</strong></div>
                    <div class="info-row"><span class="info-label">Rooms Available</span>{{ $property->rooms_available }} of {{ $property->total_rooms }}</div>
                    <div class="info-row"><span class="info-label">Status</span><span class="badge badge-{{ $property->status }}">{{ $property->statusLabel() }}</span></div>
                    <div class="info-row"><span class="info-label">Submitted</span>{{ $property->created_at->format('d M Y, H:i') }}</div>
                    @if($property->approved_at)
                    <div class="info-row"><span class="info-label">Approved On</span>{{ $property->approved_at->format('d M Y, H:i') }}</div>
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-hdr">📝 Description</div>
                <div class="card-body" style="font-size:.9rem;color:#374151;line-height:1.75;">{{ $property->description }}</div>
            </div>

            <div class="card">
                <div class="card-hdr">✅ Amenities</div>
                <div class="card-body">
                    <div class="amenity-list">
                        @if($property->has_electricity) <span class="amenity-chip">⚡ Electricity</span> @endif
                        @if($property->has_water)       <span class="amenity-chip">💧 Water</span>       @endif
                        @if($property->has_security)    <span class="amenity-chip">🔒 Security</span>    @endif
                        @if($property->is_furnished)    <span class="amenity-chip">🛋️ Furnished</span>  @endif
                        @if($property->allows_cooking)  <span class="amenity-chip">🍳 Cooking</span>    @endif
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-hdr">🔑 Landlord Information</div>
                <div class="card-body">
                    <div class="info-row"><span class="info-label">Name</span>{{ $property->landlord->user->name ?? '—' }}</div>
                    <div class="info-row"><span class="info-label">Email</span>{{ $property->landlord->user->email ?? '—' }}</div>
                    <div class="info-row"><span class="info-label">Phone</span>{{ $property->landlord->user->phone ?? '—' }}</div>
                    <div class="info-row">
                        <span class="info-label">Verification</span>
                        <span class="badge badge-{{ $property->landlord->verification_status === 'verified' ? 'approved' : ($property->landlord->verification_status === 'rejected' ? 'rejected' : 'pending') }}">
                            {{ ucfirst($property->landlord->verification_status) }}
                        </span>
                    </div>
                    <div class="info-row"><span class="info-label">Total Listings</span>{{ $property->landlord->properties()->count() }}</div>
                </div>
            </div>

            @if(!empty($property->gallery_images))
            <div class="card">
                <div class="card-hdr">📷 Gallery</div>
                <div class="card-body">
                    <div class="gallery">
                        @foreach($property->galleryImageUrls() as $url)
                            <img src="{{ $url }}" alt="Gallery">
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Right: Action Sidebar -->
        <div class="action-sidebar">
            <div class="action-card">
                <div class="ac-hdr">⚡ Admin Actions</div>
                <div class="ac-body">
                    @if($property->status !== 'approved')
                    <form method="POST" action="{{ route('admin.properties.approve', $property) }}"
                        onsubmit="return confirm('Approve this property? It will be visible to students immediately.');">
                        @csrf
                        <button type="submit" class="action-btn ab-approve">✓ Approve Listing</button>
                    </form>
                    @endif

                    @if($property->status !== 'rejected')
                    <button type="button" class="action-btn ab-reject" onclick="openModal()">
                        ✕ Reject Listing
                    </button>
                    @endif

                    <a href="{{ route('admin.properties', ['status'=>'pending']) }}" class="action-btn ab-back">
                        ← Back to Listings
                    </a>

                    <div class="ac-note">
                        @if($property->status === 'pending')
                            Awaiting your decision. Approving makes it live immediately.
                        @elseif($property->status === 'approved')
                            ✅ This property is live and visible to students.
                        @else
                            This listing has been rejected.
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div class="modal-backdrop" id="rejectModal">
    <div class="modal">
        <h3>✕ Reject: {{ $property->title }}</h3>
        <p>Optionally provide a reason for rejection. The landlord may use this to improve and resubmit.</p>
        <form method="POST" action="{{ route('admin.properties.reject', $property) }}">
            @csrf
            <textarea name="rejection_reason" placeholder="Reason for rejection (optional)…"></textarea>
            <div class="modal-actions">
                <button type="button" class="btn btn-cancel" onclick="closeModal()">Cancel</button>
                <button type="submit" class="btn btn-danger">✕ Confirm Rejection</button>
            </div>
        </form>
    </div>
</div>

<script>
const modal = document.getElementById('rejectModal');
function openModal() { modal.classList.add('open'); }
function closeModal() { modal.classList.remove('open'); }
modal.addEventListener('click', e => { if (e.target === modal) closeModal(); });
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });
</script>
</body>
</html>
