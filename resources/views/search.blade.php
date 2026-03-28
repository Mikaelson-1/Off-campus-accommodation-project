<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Search results for off-campus accommodation near BOUESTI in Ikere-Ekiti.">
    <title>Search Results — BOUESTI Off-Campus Accommodation</title>
    @vite(['resources/css/app.css', 'resources/css/bouesti.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; margin: 0; background: #f5f7fa; }
        .page-nav {
            background: #192F59;
            padding: 0 1.5rem;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 10px rgba(0,0,0,.2);
        }
        .page-nav-logo { display: flex; align-items: center; gap: .7rem; text-decoration: none; }
        .page-nav-dot { width: 34px; height: 34px; background: linear-gradient(135deg, #00A553, #007f3f); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-weight: 800; color: #fff; font-size: .85rem; }
        .page-nav-text strong { display: block; font-size: .95rem; font-weight: 800; color: #fff; }
        .page-nav-text span { font-size: .7rem; color: rgba(255,255,255,.5); }
        .page-nav-links { display: flex; gap: .75rem; align-items: center; }
        .page-nav-link { color: rgba(255,255,255,.7); text-decoration: none; font-size: .85rem; padding: .35rem .7rem; border-radius: 6px; transition: all .2s; }
        .page-nav-link:hover { color: #fff; background: rgba(255,255,255,.1); }
        .page-nav-btn { background: #00A553; color: #fff; text-decoration: none; padding: .42rem 1rem; border-radius: 7px; font-size: .85rem; font-weight: 700; transition: all .2s; }
        .page-nav-btn:hover { background: #007f3f; }

        .search-bar-section {
            background: linear-gradient(135deg, #192F59 0%, #0f1d3a 100%);
            padding: 2rem 1.5rem;
        }
        .search-bar-inner { max-width: 1100px; margin: 0 auto; }
        .search-bar-title { color: #fff; font-size: 1.3rem; font-weight: 700; margin-bottom: 1.2rem; }
        .search-bar-title span { color: #00A553; }
        .search-form {
            display: flex;
            flex-wrap: wrap;
            gap: .75rem;
            align-items: flex-end;
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.15);
            border-radius: 12px;
            padding: 1rem 1.2rem;
        }
        .sf-group { display: flex; flex-direction: column; gap: .3rem; flex: 1; min-width: 140px; }
        .sf-group label { font-size: .72rem; font-weight: 700; color: rgba(255,255,255,.65); text-transform: uppercase; letter-spacing: .4px; }
        .sf-group input, .sf-group select {
            background: rgba(255,255,255,.12); border: 1.5px solid rgba(255,255,255,.25); border-radius: 8px;
            padding: .6rem .85rem; color: #fff; font-size: .88rem; font-family: inherit; outline: none;
            transition: border-color .2s;
        }
        .sf-group input::placeholder { color: rgba(255,255,255,.45); }
        .sf-group select option { background: #192F59; }
        .sf-group input:focus, .sf-group select:focus { border-color: #00A553; }
        .sf-btn { background: #00A553; border: none; color: #fff; padding: .65rem 1.5rem; border-radius: 8px; font-weight: 700; font-size: .9rem; font-family: inherit; cursor: pointer; transition: all .2s; flex-shrink: 0; }
        .sf-btn:hover { background: #007f3f; }

        .results-section { max-width: 1100px; margin: 0 auto; padding: 2rem 1.5rem 4rem; }
        .results-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem; flex-wrap: wrap; gap: .75rem; }
        .results-count { font-size: .95rem; color: #374151; font-weight: 600; }
        .results-count span { color: #00A553; }
        .back-link { color: #192F59; font-size: .85rem; font-weight: 600; text-decoration: none; display: flex; align-items: center; gap: .3rem; }
        .back-link:hover { color: #00A553; }

        .property-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.4rem; }
        .property-card { background: #fff; border-radius: 14px; overflow: hidden; box-shadow: 0 3px 16px rgba(25,47,89,.08); transition: transform .2s, box-shadow .2s; }
        .property-card:hover { transform: translateY(-4px); box-shadow: 0 8px 28px rgba(25,47,89,.14); }
        .property-img { position: relative; height: 190px; overflow: hidden; }
        .property-img img { width: 100%; height: 100%; object-fit: cover; transition: transform .4s; }
        .property-card:hover .property-img img { transform: scale(1.05); }
        .prop-badge { position: absolute; top: .7rem; left: .7rem; background: rgba(25,47,89,.9); color: #fff; font-size: .7rem; font-weight: 700; padding: .25rem .6rem; border-radius: 5px; text-transform: uppercase; }
        .prop-verified { position: absolute; top: .7rem; right: .7rem; background: #00A553; color: #fff; font-size: .7rem; font-weight: 700; padding: .25rem .55rem; border-radius: 5px; }
        .property-body { padding: 1.2rem; }
        .prop-area { font-size: .73rem; font-weight: 700; color: #00A553; text-transform: uppercase; letter-spacing: .4px; margin-bottom: .25rem; }
        .prop-title { font-size: 1rem; font-weight: 700; color: #192F59; margin-bottom: .3rem; }
        .prop-desc { font-size: .8rem; color: #7a8ba3; line-height: 1.5; margin-bottom: .9rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .prop-amenities { display: flex; flex-wrap: wrap; gap: .35rem; margin-bottom: .9rem; }
        .prop-tag { font-size: .7rem; background: #eef1f5; color: #374151; padding: .2rem .5rem; border-radius: 5px; font-weight: 600; }
        .prop-footer { display: flex; align-items: center; justify-content: space-between; border-top: 1px solid #eef1f5; padding-top: .85rem; }
        .prop-price { font-size: 1.1rem; font-weight: 800; color: #00A553; }
        .prop-price span { font-size: .72rem; font-weight: 500; color: #7a8ba3; }
        .prop-rooms { font-size: .78rem; color: #7a8ba3; margin-top: .15rem; }
        .prop-btn { background: #192F59; color: #fff; text-decoration: none; font-size: .8rem; font-weight: 700; padding: .45rem .9rem; border-radius: 7px; transition: all .2s; }
        .prop-btn:hover { background: #0f1d3a; }

        .no-results { grid-column: 1/-1; text-align: center; padding: 4rem 2rem; }
        .no-results h3 { font-size: 1.2rem; font-weight: 700; color: #192F59; margin-bottom: .5rem; }
        .no-results p { color: #7a8ba3; font-size: .9rem; margin-bottom: 1.2rem; }
        .no-results a { background: #00A553; color: #fff; text-decoration: none; padding: .65rem 1.5rem; border-radius: 8px; font-weight: 700; font-size: .9rem; transition: all .2s; }
        .no-results a:hover { background: #007f3f; }

        .pagination { margin-top: 2rem; display: flex; justify-content: center; }

        @media (max-width: 900px) { .property-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 580px) {
            .property-grid { grid-template-columns: 1fr; }
            .search-form { flex-direction: column; }
            .sf-group { min-width: 100%; }
            .sf-btn { width: 100%; }
            .page-nav-links .page-nav-link { display: none; }
        }
    </style>
</head>
<body>
<!-- Nav -->
<nav class="page-nav">
    <a href="{{ route('home') }}" class="page-nav-logo">
        <div class="page-nav-dot">B</div>
        <div class="page-nav-text">
            <strong>BOUESTI</strong>
            <span>Off-Campus Accommodation</span>
        </div>
    </a>
    <div class="page-nav-links">
        <a href="{{ route('home') }}" class="page-nav-link">← Home</a>
        <a href="{{ route('login') }}" class="page-nav-btn"> Student Login</a>
    </div>
</nav>

<!-- Search Filter Bar -->
<div class="search-bar-section">
    <div class="search-bar-inner">
        <div class="search-bar-title">
            Search Results
            @if($area || $query) — for <span>"{{ $area ?: $query }}"</span>@endif
        </div>
        <form class="search-form" action="{{ route('properties.search') }}" method="GET">
            <div class="sf-group">
                <label> Location</label>
                <select name="location_id">
                    <option value="">All Locations</option>
                    @if($locations->where('classification', 'core_quarter')->count() > 0)
                        <optgroup label="Core Quarters">
                            @foreach($locations->where('classification', 'core_quarter') as $location)
                                <option value="{{ $location->id }}" {{ $locationId == $location->id ? 'selected' : '' }}>{{ $location->name }}</option>
                            @endforeach
                        </optgroup>
                    @endif
                    @if($locations->where('classification', 'ward')->count() > 0)
                        <optgroup label="Wards">
                            @foreach($locations->where('classification', 'ward') as $location)
                                <option value="{{ $location->id }}" {{ $locationId == $location->id ? 'selected' : '' }}>{{ $location->name }}</option>
                            @endforeach
                        </optgroup>
                    @endif
                    @if($locations->where('classification', 'neighborhood')->count() > 0)
                        <optgroup label="Neighborhoods">
                            @foreach($locations->where('classification', 'neighborhood') as $location)
                                <option value="{{ $location->id }}" {{ $locationId == $location->id ? 'selected' : '' }}>{{ $location->name }}</option>
                            @endforeach
                        </optgroup>
                    @endif
                </select>
            </div>
            <div class="sf-group">
                <label> Type</label>
                <select name="type">
                    <option value="">Any Type</option>
                    @foreach(['single_room'=>'Single Room','self_contain'=>'Self Contain','mini_flat'=>'Mini Flat','flat'=>'Flat'] as $val=>$label)
                        <option value="{{ $val }}" {{ $type === $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="sf-group">
                <label> Keyword</label>
                <input type="text" name="q" value="{{ $query }}" placeholder="e.g. Sunshine Lodge...">
            </div>
            <div class="sf-group">
                <label> Max Price (₦/yr)</label>
                <input type="number" name="max_price" value="{{ $maxPrice }}" placeholder="e.g. 100000" step="5000">
            </div>
            <button type="submit" class="sf-btn">Search</button>
        </form>
    </div>
</div>

<!-- Results -->
<div class="results-section">
    <div class="results-header">
        <div class="results-count">
            Showing <span>{{ $properties->total() }}</span> result{{ $properties->total() !== 1 ? 's' : '' }}
            @if($area) in <strong>{{ $area }}</strong>@endif
        </div>
        <a href="{{ route('home') }}" class="back-link">← Back to Home</a>
    </div>

    <div class="property-grid">
        @forelse ($properties as $property)
            <div class="property-card">
                <div class="property-img">
                    <img src="{{ $property->coverImageUrl() }}" alt="{{ $property->title }}" loading="lazy">
                    <div class="prop-badge">{{ $property->typeLabel() }}</div>
                    <div class="prop-verified"> Verified</div>
                </div>
                <div class="property-body">
                    <div class="prop-area"> {{ $property->area }}, {{ $property->city }}</div>
                    <div class="prop-title">{{ $property->title }}</div>
                    <div class="prop-desc">{{ $property->description }}</div>
                    <div class="prop-amenities">
                        @if($property->has_electricity) <span class="prop-tag"> Electricity</span> @endif
                        @if($property->has_water)      <span class="prop-tag"> Water</span>       @endif
                        @if($property->has_security)   <span class="prop-tag">🔒 Security</span>   @endif
                        @if($property->is_furnished)   <span class="prop-tag"> Furnished</span>  @endif
                        @if($property->allows_cooking) <span class="prop-tag"> Cooking</span>    @endif
                    </div>
                    <div class="prop-footer">
                        <div>
                            <div class="prop-price">{{ $property->formattedPrice() }} <span>/ year</span></div>
                            <div class="prop-rooms"> {{ $property->rooms_available }} room{{ $property->rooms_available !== 1 ? 's' : '' }} available</div>
                        </div>
                        <a href="{{ route('login') }}" class="prop-btn">View →</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="no-results">
                <h3>No Properties Found</h3>
                <p>No accommodation matches your current filters. Try adjusting your search or browse all listings.</p>
                <a href="{{ route('properties.search') }}">Browse All</a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="pagination">
        {{ $properties->withQueryString()->links() }}
    </div>
</div>
</body>
</html>
