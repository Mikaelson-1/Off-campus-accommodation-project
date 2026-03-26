<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $property->title }} — Landlord Portal</title>
    @vite(['resources/css/app.css', 'resources/css/bouesti.css', 'resources/js/app.js'])
    <style>
        body { font-family:'Inter',sans-serif; margin:0; background:#f0f2f5; }
        .ld-nav { background:linear-gradient(90deg,#0f1d3a,#192F59); height:64px; display:flex; align-items:center; padding:0 2rem; justify-content:space-between; box-shadow:0 2px 12px rgba(0,0,0,.25); }
        .ld-nav-logo { display:flex; align-items:center; gap:.8rem; text-decoration:none; }
        .ld-nav-dot { width:38px; height:38px; background:linear-gradient(135deg,#00A553,#007f3f); border-radius:9px; display:flex; align-items:center; justify-content:center; font-weight:800; color:#fff; font-size:.9rem; }
        .ld-nav-text strong { display:block; font-size:.95rem; font-weight:800; color:#fff; }
        .ld-nav-text span { font-size:.7rem; color:rgba(255,255,255,.5); }
        .ld-nav-link { color:rgba(255,255,255,.7); text-decoration:none; font-size:.85rem; padding:.38rem .8rem; border-radius:7px; transition:all .2s; }
        .ld-nav-link:hover { background:rgba(255,255,255,.1); color:#fff; }

        .page { max-width:900px; margin:2.5rem auto; padding:0 1.5rem 4rem; }
        .breadcrumb { display:flex; align-items:center; gap:.5rem; font-size:.8rem; color:#9ca3af; margin-bottom:1rem; }
        .breadcrumb a { color:#00A553; text-decoration:none; }

        .prop-hero { border-radius:16px; overflow:hidden; margin-bottom:1.5rem; height:340px; position:relative; }
        .prop-hero img { width:100%; height:100%; object-fit:cover; }
        .prop-hero-overlay { position:absolute; inset:0; background:linear-gradient(to top, rgba(25,47,89,.8) 0%, transparent 60%); display:flex; align-items:flex-end; padding:1.5rem; }
        .prop-hero-title { color:#fff; font-size:1.5rem; font-weight:800; }

        .detail-grid { display:grid; grid-template-columns:2fr 1fr; gap:1.5rem; }

        .card { background:#fff; border-radius:14px; box-shadow:0 3px 14px rgba(25,47,89,.08); margin-bottom:1.5rem; }
        .card-header { padding:1rem 1.4rem; border-bottom:1px solid #f0f2f5; font-size:.95rem; font-weight:700; color:#192F59; }
        .card-body { padding:1.4rem; }

        .info-row { display:flex; align-items:flex-start; gap:.6rem; padding:.55rem 0; border-bottom:1px solid #f7f8fa; font-size:.88rem; color:#374151; }
        .info-row:last-child { border-bottom:none; }
        .info-label { font-weight:700; color:#9ca3af; min-width:140px; flex-shrink:0; font-size:.78rem; text-transform:uppercase; letter-spacing:.3px; }

        .status-badge { display:inline-flex; align-items:center; gap:.3rem; padding:.3rem .8rem; border-radius:20px; font-size:.78rem; font-weight:800; text-transform:uppercase; }
        .status-pending  { background:rgba(240,165,0,.12); color:#92400e; }
        .status-approved { background:rgba(0,165,83,.12); color:#065f35; }
        .status-rejected { background:rgba(229,62,62,.1); color:#7f1d1d; }

        .amenity-list { display:flex; flex-wrap:wrap; gap:.5rem; }
        .amenity-chip { background:#eef1f5; color:#374151; font-size:.8rem; font-weight:600; padding:.3rem .75rem; border-radius:20px; }

        .gallery { display:grid; grid-template-columns:repeat(3,1fr); gap:.5rem; margin-top:1rem; }
        .gallery img { width:100%; height:80px; object-fit:cover; border-radius:8px; }

        .action-card { position:sticky; top:1.5rem; }
        .action-btn { display:flex; align-items:center; justify-content:center; gap:.5rem; padding:.8rem; border-radius:10px; font-size:.9rem; font-weight:700; text-decoration:none; margin-bottom:.75rem; transition:all .2s; border:none; cursor:pointer; font-family:inherit; width:100%; }
        .btn-back { background:#eef1f5; color:#192F59; }
        .btn-back:hover { background:#dce2ee; }
        .btn-del { background:rgba(229,62,62,.1); color:#c0392b; }
        .btn-del:hover { background:rgba(229,62,62,.18); }

        @media (max-width:700px) {
            .detail-grid { grid-template-columns:1fr; }
            .action-card { position:static; }
            .prop-hero { height:220px; }
        }
    </style>
</head>
<body>
<nav class="ld-nav">
    <a href="{{ route('home') }}" class="ld-nav-logo">
        <div class="ld-nav-dot">B</div>
        <div class="ld-nav-text"><strong>BOUESTI</strong><span>Landlord Portal</span></div>
    </a>
    <div style="display:flex; gap:.5rem;">
        <a href="{{ route('landlord.dashboard') }}" class="ld-nav-link">← Dashboard</a>
    </div>
</nav>

<div class="page">
    <div class="breadcrumb">
        <a href="{{ route('landlord.dashboard') }}">Dashboard</a>
        <span>›</span>
        <span>{{ $property->title }}</span>
    </div>

    <!-- Hero Image -->
    <div class="prop-hero">
        <img src="{{ $property->coverImageUrl() }}" alt="{{ $property->title }}">
        <div class="prop-hero-overlay">
            <div>
                <div class="prop-hero-title">{{ $property->title }}</div>
                <span class="status-badge status-{{ $property->status }}" style="margin-top:.4rem; display:inline-flex;">
                    {{ $property->statusLabel() }}
                </span>
            </div>
        </div>
    </div>

    <div class="detail-grid">
        <div>
            <!-- Details -->
            <div class="card">
                <div class="card-header">📋 Property Details</div>
                <div class="card-body">
                    <div class="info-row"><span class="info-label">Address</span>{{ $property->address }}</div>
                    <div class="info-row"><span class="info-label">Area</span>{{ $property->area }}, {{ $property->city }}</div>
                    <div class="info-row"><span class="info-label">Distance</span>{{ $property->distance_from_campus ?? '—' }} from BOUESTI</div>
                    <div class="info-row"><span class="info-label">Type</span>{{ $property->typeLabel() }}</div>
                    <div class="info-row"><span class="info-label">Price / Year</span><strong style="color:#00A553;">{{ $property->formattedPrice() }}</strong></div>
                    <div class="info-row"><span class="info-label">Rooms</span>{{ $property->rooms_available }} available / {{ $property->total_rooms }} total</div>
                    <div class="info-row"><span class="info-label">Submitted</span>{{ $property->created_at->format('d M Y') }}</div>
                    @if($property->approved_at)
                    <div class="info-row"><span class="info-label">Approved</span>{{ $property->approved_at->format('d M Y') }}</div>
                    @endif
                </div>
            </div>

            <!-- Description -->
            <div class="card">
                <div class="card-header">📝 Description</div>
                <div class="card-body" style="font-size:.9rem; color:#374151; line-height:1.7;">
                    {{ $property->description }}
                </div>
            </div>

            <!-- Amenities -->
            <div class="card">
                <div class="card-header">✅ Amenities</div>
                <div class="card-body">
                    <div class="amenity-list">
                        @if($property->has_electricity) <span class="amenity-chip">⚡ Electricity</span> @endif
                        @if($property->has_water)       <span class="amenity-chip">💧 Water</span>       @endif
                        @if($property->has_security)    <span class="amenity-chip">🔒 Security</span>    @endif
                        @if($property->is_furnished)    <span class="amenity-chip">🛋️ Furnished</span>   @endif
                        @if($property->allows_cooking)  <span class="amenity-chip">🍳 Cooking</span>     @endif
                        @if(!$property->has_electricity && !$property->has_water && !$property->has_security && !$property->is_furnished && !$property->allows_cooking)
                            <span style="color:#9ca3af; font-size:.85rem;">No amenities recorded.</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Gallery -->
            @if(!empty($property->gallery_images))
            <div class="card">
                <div class="card-header">📷 Gallery</div>
                <div class="card-body">
                    <div class="gallery">
                        @foreach($property->galleryImageUrls() as $imgUrl)
                            <img src="{{ $imgUrl }}" alt="Gallery photo">
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Action Sidebar -->
        <div>
            <div class="card action-card">
                <div class="card-header">⚡ Actions</div>
                <div class="card-body">
                    <a href="{{ route('landlord.dashboard') }}" class="action-btn btn-back">
                        ← Back to Dashboard
                    </a>
                    @if(in_array($property->status, ['pending','rejected']))
                    <form method="POST" action="{{ route('landlord.properties.destroy', $property) }}"
                        onsubmit="return confirm('Are you sure you want to delete this listing? This cannot be undone.');">
                        @csrf @method('DELETE')
                        <button type="submit" class="action-btn btn-del">
                            🗑 Delete Listing
                        </button>
                    </form>
                    @endif

                    <div style="font-size:.78rem; color:#9ca3af; text-align:center; margin-top:.5rem; line-height:1.5;">
                        @if($property->status === 'pending')
                            Awaiting admin review. You'll be notified on approval.
                        @elseif($property->status === 'approved')
                            ✅ This listing is live and visible to students.
                        @elseif($property->status === 'rejected')
                            This listing was rejected. Delete it and create a new one.
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
