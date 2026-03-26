<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List New Property — BOUESTI Landlord Portal</title>
    @vite(['resources/css/app.css', 'resources/css/bouesti.css', 'resources/js/app.js'])
    <style>
        body { font-family:'Inter',sans-serif; margin:0; background:#f0f2f5; }

        /* ── Navbar ─────────────────────────────────────────────────── */
        .ld-nav { background:linear-gradient(90deg,#0f1d3a,#192F59); height:64px; display:flex; align-items:center; padding:0 2rem; justify-content:space-between; box-shadow:0 2px 12px rgba(0,0,0,.25); position:sticky; top:0; z-index:100; }
        .ld-nav-logo { display:flex; align-items:center; gap:.8rem; text-decoration:none; }
        .ld-nav-dot { width:38px; height:38px; background:linear-gradient(135deg,#00A553,#007f3f); border-radius:9px; display:flex; align-items:center; justify-content:center; font-weight:800; color:#fff; font-size:.9rem; }
        .ld-nav-text strong { display:block; font-size:.95rem; font-weight:800; color:#fff; }
        .ld-nav-text span { font-size:.7rem; color:rgba(255,255,255,.5); }
        .ld-nav-right { display:flex; align-items:center; gap:.75rem; }
        .ld-nav-link { color:rgba(255,255,255,.7); text-decoration:none; font-size:.85rem; padding:.38rem .8rem; border-radius:7px; transition:all .2s; }
        .ld-nav-link:hover { background:rgba(255,255,255,.1); color:#fff; }

        /* ── Page Wrapper ────────────────────────────────────────────── */
        .page-wrap { max-width: 860px; margin: 2.5rem auto; padding: 0 1.5rem 4rem; }
        .page-header { margin-bottom: 2rem; }
        .page-header h1 { font-size: 1.5rem; font-weight: 800; color: #192F59; margin-bottom: .3rem; display: flex; align-items: center; gap: .5rem; }
        .page-header p { font-size: .9rem; color: #7a8ba3; }
        .breadcrumb { display: flex; align-items: center; gap: .5rem; font-size: .8rem; color: #9ca3af; margin-bottom: 1rem; }
        .breadcrumb a { color: #00A553; text-decoration: none; }
        .breadcrumb a:hover { text-decoration: underline; }

        /* ── Form Card ───────────────────────────────────────────────── */
        .form-card { background: #fff; border-radius: 16px; box-shadow: 0 4px 20px rgba(25,47,89,.09); overflow: hidden; }
        .form-section { border-bottom: 1px solid #f0f2f5; }
        .form-section:last-child { border-bottom: none; }
        .form-section-header { padding: 1.2rem 1.8rem; background: #fafbfc; display: flex; align-items: center; gap: .6rem; }
        .form-section-header h3 { font-size: .95rem; font-weight: 700; color: #192F59; }
        .form-section-dot { width: 8px; height: 8px; border-radius: 50%; background: #00A553; flex-shrink: 0; }
        .form-section-body { padding: 1.5rem 1.8rem; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1.2rem; }
        .form-grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1.2rem; }
        .form-full { grid-column: 1 / -1; }

        /* ── Field ───────────────────────────────────────────────────── */
        .field { display: flex; flex-direction: column; gap: .35rem; }
        .field label { font-size: .78rem; font-weight: 700; color: #192F59; text-transform: uppercase; letter-spacing: .3px; }
        .field label .req { color: #e53e3e; margin-left: .2rem; }
        .field input, .field select, .field textarea {
            padding: .72rem .95rem;
            border: 1.5px solid #d4dae5;
            border-radius: 9px;
            font-family: inherit;
            font-size: .9rem;
            color: #374151;
            background: #f9fafb;
            transition: border-color .2s, box-shadow .2s, background .2s;
            outline: none;
            width: 100%;
            box-sizing: border-box;
        }
        .field input:focus, .field select:focus, .field textarea:focus {
            border-color: #00A553;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(0,165,83,.12);
        }
        .field input.invalid, .field select.invalid, .field textarea.invalid {
            border-color: #e53e3e;
            box-shadow: 0 0 0 3px rgba(229,62,62,.1);
        }
        .field-hint { font-size: .74rem; color: #9ca3af; }
        .field-error { font-size: .76rem; color: #e53e3e; display: none; margin-top: -.25rem; }
        .field-error.show { display: block; }
        .field textarea { resize: vertical; min-height: 110px; }

        /* ── Price prefix ────────────────────────────────────────────── */
        .input-group { display: flex; }
        .input-prefix { background: #eef1f5; border: 1.5px solid #d4dae5; border-right: none; border-radius: 9px 0 0 9px; padding: .72rem .9rem; font-size: .95rem; font-weight: 700; color: #192F59; flex-shrink: 0; display: flex; align-items: center; }
        .input-group input { border-radius: 0 9px 9px 0; }

        /* ── Amenities checkboxes ─────────────────────────────────────── */
        .amenity-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: .75rem; }
        .amenity-item { position: relative; }
        .amenity-item input[type="checkbox"] { position: absolute; opacity: 0; width: 0; height: 0; }
        .amenity-label {
            display: flex; align-items: center; gap: .6rem;
            padding: .7rem .9rem;
            border: 1.5px solid #d4dae5;
            border-radius: 9px;
            cursor: pointer;
            font-size: .85rem;
            font-weight: 600;
            color: #374151;
            transition: all .18s;
            user-select: none;
        }
        .amenity-label:hover { border-color: #00A553; background: rgba(0,165,83,.04); }
        .amenity-item input[type="checkbox"]:checked + .amenity-label {
            border-color: #00A553;
            background: rgba(0,165,83,.09);
            color: #065f35;
        }
        .amenity-label .a-icon { font-size: 1.1rem; }
        .amenity-check { width: 18px; height: 18px; border: 2px solid #d4dae5; border-radius: 4px; margin-left: auto; display: flex; align-items: center; justify-content: center; transition: all .15s; flex-shrink: 0; }
        .amenity-item input[type="checkbox"]:checked + .amenity-label .amenity-check { background: #00A553; border-color: #00A553; }
        .amenity-item input[type="checkbox"]:checked + .amenity-label .amenity-check::after { content: '✓'; color: #fff; font-size: .72rem; font-weight: 800; }

        /* ── Image Upload ────────────────────────────────────────────── */
        .upload-zone {
            border: 2px dashed #d4dae5;
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all .2s;
            background: #fafbfc;
            position: relative;
        }
        .upload-zone:hover, .upload-zone.drag-over {
            border-color: #00A553;
            background: rgba(0,165,83,.04);
        }
        .upload-zone input[type="file"] { position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%; }
        .upload-icon { font-size: 2rem; margin-bottom: .5rem; }
        .upload-title { font-size: .9rem; font-weight: 700; color: #192F59; margin-bottom: .25rem; }
        .upload-sub { font-size: .78rem; color: #9ca3af; }
        .upload-preview { display: flex; flex-wrap: wrap; gap: .6rem; margin-top: 1rem; }
        .preview-thumb { position: relative; width: 80px; height: 64px; }
        .preview-thumb img { width: 80px; height: 64px; object-fit: cover; border-radius: 7px; border: 2px solid #eef1f5; }
        .preview-thumb .remove-img { position: absolute; top: -6px; right: -6px; width:18px; height:18px; background:#e53e3e; color:#fff; border: none; border-radius: 50%; font-size: .7rem; cursor: pointer; display: flex; align-items: center; justify-content: center; }

        /* ── Submit bar ──────────────────────────────────────────────── */
        .form-footer { padding: 1.4rem 1.8rem; background: #fafbfc; border-top: 1px solid #f0f2f5; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: .75rem; }
        .pending-note { font-size: .82rem; color: #d97706; display: flex; align-items: center; gap: .4rem; font-weight: 600; }
        .submit-btn {
            background: linear-gradient(135deg, #00A553, #007f3f);
            color: #fff; border: none; border-radius: 10px;
            padding: .85rem 2.2rem; font-size: .95rem; font-weight: 700;
            cursor: pointer; font-family: inherit;
            transition: all .2s;
            box-shadow: 0 4px 14px rgba(0,165,83,.35);
            display: flex; align-items: center; gap: .5rem;
        }
        .submit-btn:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0,165,83,.45); }
        .submit-btn:disabled { opacity: .6; cursor: not-allowed; transform: none; }

        /* ── Validation summary ──────────────────────────────────────── */
        .validation-banner { background: rgba(229,62,62,.08); border: 1px solid rgba(229,62,62,.3); border-radius: 10px; padding: .9rem 1.2rem; margin-bottom: 1.5rem; font-size: .85rem; color: #7f1d1d; display: none; }
        .validation-banner.show { display: flex; align-items: flex-start; gap: .6rem; }
        .validation-banner ul { margin: .3rem 0 0 1rem; }
        .validation-banner li { margin-bottom: .2rem; }

        /* ── Server errors ───────────────────────────────────────────── */
        .server-error { background: rgba(229,62,62,.08); border: 1px solid rgba(229,62,62,.3); border-radius: 10px; padding: .9rem 1.2rem; margin-bottom: 1.5rem; font-size: .85rem; color: #7f1d1d; }
        .server-error ul { margin: .4rem 0 0 1.2rem; }

        @media (max-width: 640px) {
            .form-grid, .form-grid-3, .amenity-grid { grid-template-columns: 1fr; }
            .form-section-body, .form-footer { padding: 1.2rem; }
            .page-wrap { padding: 0 .9rem 3rem; }
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
        <a href="{{ route('landlord.dashboard') }}" class="ld-nav-link">← Dashboard</a>
    </div>
</nav>

<!-- ── Page Content ───────────────────────────────────────────────── -->
<div class="page-wrap">
    <div class="breadcrumb">
        <a href="{{ route('landlord.dashboard') }}">Dashboard</a>
        <span>›</span>
        <span>List New Property</span>
    </div>

    <div class="page-header">
        <h1>🏠 List New Property</h1>
        <p>Fill in all the details about your accommodation. Your listing will be reviewed by admin before going live.</p>
    </div>

    {{-- Server Validation Errors --}}
    @if($errors->any())
        <div class="server-error">
            ✕ <strong>Please fix the following errors:</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- JS Validation Banner --}}
    <div class="validation-banner" id="validationBanner">
        <span>⚠️</span>
        <div>
            <strong>Please fill in all required fields:</strong>
            <ul id="validationList"></ul>
        </div>
    </div>

    {{-- Only verified landlords can submit --}}
    @if(!$landlord->isVerified())
        <div style="background:rgba(240,165,0,.1); border:1px solid rgba(240,165,0,.35); color:#6b4500; border-radius:10px; padding:.9rem 1.2rem; margin-bottom:1.5rem; font-size:.88rem;">
            ⏳ <strong>Account not yet verified.</strong> You can view the form but submissions require admin verification of your account first.
        </div>
    @endif

    <form
        id="propertyForm"
        method="POST"
        action="{{ route('landlord.properties.store') }}"
        enctype="multipart/form-data"
        novalidate
    >
        @csrf

        <div class="form-card">

            {{-- ── Section 1: Basic Info ───────────────────────────── --}}
            <div class="form-section">
                <div class="form-section-header">
                    <div class="form-section-dot"></div>
                    <h3>Basic Information</h3>
                </div>
                <div class="form-section-body">
                    <div class="form-grid">
                        <div class="field form-full">
                            <label for="title">Property Title <span class="req">*</span></label>
                            <input type="text" id="title" name="title" value="{{ old('title') }}"
                                placeholder="e.g. Grace Court Hostel, Block B"
                                data-label="Property Title" required />
                            <div class="field-error" id="err-title">Please enter the property title.</div>
                        </div>

                        <div class="field">
                            <label for="type">Accommodation Type <span class="req">*</span></label>
                            <select id="type" name="type" data-label="Accommodation Type" required>
                                <option value="">— Select type —</option>
                                <option value="single_room"  {{ old('type') === 'single_room'  ? 'selected' : '' }}>Single Room</option>
                                <option value="self_contain" {{ old('type') === 'self_contain'  ? 'selected' : '' }}>Self Contain</option>
                                <option value="mini_flat"    {{ old('type') === 'mini_flat'     ? 'selected' : '' }}>Mini Flat</option>
                                <option value="flat"         {{ old('type') === 'flat'          ? 'selected' : '' }}>Flat</option>
                                <option value="duplex"       {{ old('type') === 'duplex'        ? 'selected' : '' }}>Duplex</option>
                            </select>
                            <div class="field-error" id="err-type">Please select the accommodation type.</div>
                        </div>

                        <div class="field">
                            <label for="area">Neighbourhood / Area <span class="req">*</span></label>
                            <select id="area" name="area" data-label="Area" required>
                                <option value="">— Select area —</option>
                                @foreach(['Odo-Oja','Afon Lodge area','Temidire','Ilawe Road','Ijigbo','Aba-Odo','Ado Road','Other'] as $a)
                                    <option value="{{ $a }}" {{ old('area') === $a ? 'selected' : '' }}>{{ $a }}</option>
                                @endforeach
                            </select>
                            <div class="field-error" id="err-area">Please select the area.</div>
                        </div>

                        <div class="field form-full">
                            <label for="address">Full Address <span class="req">*</span></label>
                            <input type="text" id="address" name="address" value="{{ old('address') }}"
                                placeholder="e.g. 12 Afon Lodge Road, Ikere-Ekiti, Ekiti State"
                                data-label="Full Address" required />
                            <div class="field-error" id="err-address">Please enter the full address.</div>
                        </div>

                        <div class="field">
                            <label for="distance_from_campus">Distance from BOUESTI Campus <span class="req">*</span></label>
                            <select id="distance_from_campus" name="distance_from_campus" data-label="Distance from campus" required>
                                <option value="">— Select distance —</option>
                                @foreach(['5 minutes walk','10 minutes walk','15 minutes walk','Within 500m','Within 1km','1–2km','2–3km','More than 3km'] as $d)
                                    <option value="{{ $d }}" {{ old('distance_from_campus') === $d ? 'selected' : '' }}>{{ $d }}</option>
                                @endforeach
                            </select>
                            <div class="field-hint">How far is the property from BOUESTI main gate?</div>
                            <div class="field-error" id="err-distance_from_campus">Please select distance from campus.</div>
                        </div>

                        <div class="field">
                            <label for="price_per_year">Annual Rent (₦) <span class="req">*</span></label>
                            <div class="input-group">
                                <span class="input-prefix">₦</span>
                                <input type="number" id="price_per_year" name="price_per_year"
                                    value="{{ old('price_per_year') }}"
                                    placeholder="e.g. 85000"
                                    min="10000" max="2000000" step="1000"
                                    data-label="Annual Rent" required />
                            </div>
                            <div class="field-hint">Minimum ₦10,000 — Maximum ₦2,000,000</div>
                            <div class="field-error" id="err-price_per_year">Please enter a valid annual rent amount.</div>
                        </div>

                        <div class="field">
                            <label for="total_rooms">Total Rooms in Property <span class="req">*</span></label>
                            <input type="number" id="total_rooms" name="total_rooms"
                                value="{{ old('total_rooms', 1) }}"
                                min="1" max="50" data-label="Total Rooms" required />
                            <div class="field-error" id="err-total_rooms">Please enter the total number of rooms.</div>
                        </div>

                        <div class="field">
                            <label for="rooms_available">Rooms Currently Available <span class="req">*</span></label>
                            <input type="number" id="rooms_available" name="rooms_available"
                                value="{{ old('rooms_available', 1) }}"
                                min="1" max="50" data-label="Rooms Available" required />
                            <div class="field-error" id="err-rooms_available">Please enter rooms available.</div>
                        </div>

                        <div class="field form-full">
                            <label for="description">Description <span class="req">*</span></label>
                            <textarea id="description" name="description"
                                placeholder="Describe your property — proximity to campus, security, environment, what makes it a great place for students..."
                                data-label="Description" required minlength="30">{{ old('description') }}</textarea>
                            <div class="field-hint">Minimum 30 characters. Be detailed — students read this carefully.</div>
                            <div class="field-error" id="err-description">Please describe the property (at least 30 characters).</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Section 2: Amenities ────────────────────────────── --}}
            <div class="form-section">
                <div class="form-section-header">
                    <div class="form-section-dot"></div>
                    <h3>Amenities & Features</h3>
                </div>
                <div class="form-section-body">
                    <div class="amenity-grid">
                        @php
                            $amenities = [
                                'has_electricity' => ['⚡', 'Electricity', 'PHCN / Generator'],
                                'has_water'       => ['💧', 'Running Water', 'Tap / Borehole'],
                                'has_security'    => ['🔒', 'Security', 'Gate / Guard'],
                                'is_furnished'    => ['🛋️', 'Furnished', 'Bed, Wardrobe'],
                                'allows_cooking'  => ['🍳', 'Cooking Allowed', 'Kitchen access'],
                            ];
                        @endphp
                        @foreach($amenities as $name => [$icon, $label, $sub])
                            <div class="amenity-item">
                                <input type="checkbox" id="{{ $name }}" name="{{ $name }}" value="1"
                                    {{ old($name, in_array($name, ['has_electricity','has_water','allows_cooking']) ? '1' : '') ? 'checked' : '' }}>
                                <label class="amenity-label" for="{{ $name }}">
                                    <span class="a-icon">{{ $icon }}</span>
                                    <div>
                                        <div style="font-size:.85rem; font-weight:700;">{{ $label }}</div>
                                        <div style="font-size:.72rem; color:#9ca3af; font-weight:500;">{{ $sub }}</div>
                                    </div>
                                    <div class="amenity-check"></div>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- ── Section 3: Photos ───────────────────────────────── --}}
            <div class="form-section">
                <div class="form-section-header">
                    <div class="form-section-dot"></div>
                    <h3>Property Photos</h3>
                </div>
                <div class="form-section-body">
                    <div class="form-grid">
                        <div class="field form-full">
                            <label>Cover Photo <span class="req">*</span></label>
                            <div class="upload-zone" id="coverZone">
                                <input type="file" id="cover_image" name="cover_image"
                                    accept="image/jpeg,image/png,image/jpg,image/webp"
                                    data-label="Cover Photo" required />
                                <div class="upload-icon">🖼️</div>
                                <div class="upload-title">Click or drag to upload cover photo</div>
                                <div class="upload-sub">JPEG, PNG or WebP — max 5MB</div>
                            </div>
                            <div class="upload-preview" id="coverPreview"></div>
                            <div class="field-error" id="err-cover_image">Please upload a cover photo for your property.</div>
                        </div>

                        <div class="field form-full">
                            <label>Gallery Photos <span style="font-weight:500; color:#9ca3af;">(optional, max 5)</span></label>
                            <div class="upload-zone" id="galleryZone">
                                <input type="file" id="gallery_images" name="gallery_images[]"
                                    accept="image/jpeg,image/png,image/jpg,image/webp"
                                    multiple />
                                <div class="upload-icon">📷</div>
                                <div class="upload-title">Click or drag to upload gallery photos</div>
                                <div class="upload-sub">Up to 5 images — JPEG, PNG or WebP — max 5MB each</div>
                            </div>
                            <div class="upload-preview" id="galleryPreview"></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Footer / Submit ─────────────────────────────────── --}}
            <div class="form-footer">
                <div class="pending-note">
                    ⏳ Your listing will be reviewed by admin before going live
                </div>
                <button type="submit" class="submit-btn" id="submitBtn"
                    {{ !$landlord->isVerified() ? 'disabled' : '' }}>
                    <span id="submitBtnText">Submit for Review</span>
                    <span id="submitBtnSpinner" style="display:none">⏳</span>
                </button>
            </div>

        </div>{{-- /.form-card --}}
    </form>
</div>

<script>
/* ════════════════════════════════════════════════════════════════
   PROPERTY FORM JAVASCRIPT VALIDATION
   ════════════════════════════════════════════════════════════════ */

// ── Required text / select / textarea fields ─────────────────────
const requiredFields = [
    { id: 'title',                 label: 'Property Title' },
    { id: 'type',                  label: 'Accommodation Type' },
    { id: 'area',                  label: 'Area / Neighbourhood' },
    { id: 'address',               label: 'Full Address' },
    { id: 'distance_from_campus',  label: 'Distance from Campus' },
    { id: 'price_per_year',        label: 'Annual Rent' },
    { id: 'total_rooms',           label: 'Total Rooms' },
    { id: 'rooms_available',       label: 'Rooms Available' },
    { id: 'description',           label: 'Description' },
];

// ── Real-time validation on blur ──────────────────────────────────
requiredFields.forEach(({ id }) => {
    const el = document.getElementById(id);
    if (!el) return;
    el.addEventListener('blur', () => validateField(el));
    el.addEventListener('input', () => {
        if (el.classList.contains('invalid')) validateField(el);
    });
});

function validateField(el) {
    const errEl = document.getElementById('err-' + el.id);
    const val   = el.value.trim();
    let valid   = val !== '';

    // Extra: description min length
    if (el.id === 'description' && val.length < 30) valid = false;
    // Extra: price range
    if (el.id === 'price_per_year') {
        const n = Number(val);
        valid = n >= 10000 && n <= 2000000;
    }
    // Extra: rooms available ≤ total rooms
    if (el.id === 'rooms_available') {
        const avail = Number(val);
        const total = Number(document.getElementById('total_rooms').value);
        if (total > 0 && avail > total) {
            valid = false;
            if (errEl) errEl.textContent = 'Rooms available cannot exceed total rooms.';
        }
    }

    el.classList.toggle('invalid', !valid);
    if (errEl) errEl.classList.toggle('show', !valid);
    return valid;
}

// ── Cover image required validation ──────────────────────────────
const coverInput = document.getElementById('cover_image');
coverInput.addEventListener('change', () => {
    const errEl = document.getElementById('err-cover_image');
    errEl.classList.toggle('show', coverInput.files.length === 0);
});

// ── Main form submit validation ───────────────────────────────────
document.getElementById('propertyForm').addEventListener('submit', function (e) {
    const errors = [];
    let firstInvalid = null;

    // Validate all required fields
    requiredFields.forEach(({ id, label }) => {
        const el = document.getElementById(id);
        if (!el) return;
        const valid = validateField(el);
        if (!valid) {
            errors.push(label);
            if (!firstInvalid) firstInvalid = el;
        }
    });

    // Validate cover image
    if (coverInput.files.length === 0) {
        errors.push('Cover Photo');
        document.getElementById('err-cover_image').classList.add('show');
        if (!firstInvalid) firstInvalid = coverInput;
    }

    // Gallery: max 5 files
    const galleryInput = document.getElementById('gallery_images');
    if (galleryInput.files.length > 5) {
        errors.push('Gallery Photos (max 5)');
        alert('You can upload a maximum of 5 gallery photos.');
        if (!firstInvalid) firstInvalid = galleryInput;
    }

    if (errors.length > 0) {
        e.preventDefault();

        // Show banner
        const banner = document.getElementById('validationBanner');
        const list   = document.getElementById('validationList');
        list.innerHTML = errors.map(e => `<li>${e}</li>`).join('');
        banner.classList.add('show');
        banner.scrollIntoView({ behavior: 'smooth', block: 'center' });

        if (firstInvalid) firstInvalid.focus();
        return;
    }

    // Hide banner, show loading
    document.getElementById('validationBanner').classList.remove('show');
    const btn  = document.getElementById('submitBtn');
    const txt  = document.getElementById('submitBtnText');
    const spin = document.getElementById('submitBtnSpinner');
    btn.disabled = true;
    txt.textContent = 'Submitting…';
    spin.style.display = 'inline';
});

// ── Image preview helper ──────────────────────────────────────────
function setupPreview(inputId, previewId, maxFiles = 1) {
    const input   = document.getElementById(inputId);
    const preview = document.getElementById(previewId);
    const zone    = input.closest('.upload-zone');

    input.addEventListener('change', () => {
        preview.innerHTML = '';
        const files = Array.from(input.files).slice(0, maxFiles);

        // Update upload zone appearance
        zone.classList.toggle('drag-over', files.length > 0);

        files.forEach((file, i) => {
            if (!file.type.startsWith('image/')) return;
            const reader = new FileReader();
            reader.onload = (ev) => {
                const wrap = document.createElement('div');
                wrap.className = 'preview-thumb';
                wrap.innerHTML = `
                    <img src="${ev.target.result}" alt="Preview ${i+1}" />
                `;
                preview.appendChild(wrap);
            };
            reader.readAsDataURL(file);
        });

        if (inputId === 'cover_image' && files.length > 0) {
            const zone = document.getElementById('coverZone');
            zone.querySelector('.upload-title').textContent = files[0].name;
            zone.querySelector('.upload-sub').textContent   = (files[0].size / 1024 / 1024).toFixed(2) + ' MB';
        }
    });

    // Drag & drop
    zone.addEventListener('dragover', (e) => { e.preventDefault(); zone.classList.add('drag-over'); });
    zone.addEventListener('dragleave', ()  => zone.classList.remove('drag-over'));
    zone.addEventListener('drop', (e) => {
        e.preventDefault();
        zone.classList.remove('drag-over');
        const dt  = e.dataTransfer;
        const inp = zone.querySelector('input[type="file"]');
        if (dt && inp) {
            // Assign dropped files
            try {
                inp.files = dt.files;
                inp.dispatchEvent(new Event('change'));
            } catch (_) {
                // DataTransfer assignment not always supported — silently skip
            }
        }
    });
}

setupPreview('cover_image', 'coverPreview', 1);
setupPreview('gallery_images', 'galleryPreview', 5);

// ── Live character count for description ──────────────────────────
const descEl = document.getElementById('description');
const hint   = descEl.nextElementSibling;
descEl.addEventListener('input', () => {
    const len  = descEl.value.trim().length;
    const minOk = len >= 30;
    hint.textContent = minOk
        ? `✓ ${len} characters — good!`
        : `${len}/30 minimum characters`;
    hint.style.color = minOk ? '#00A553' : '#d97706';
});
</script>
</body>
</html>
