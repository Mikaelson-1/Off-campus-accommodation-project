<?php

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PropertyController extends Controller
{
    // ─── List landlord's own properties ────────────────────────────────────────
    public function index(): View
    {
        $landlord   = Auth::user()->landlord;
        $properties = Property::where('landlord_id', $landlord->id)
            ->latest()
            ->get();

        return view('landlord.dashboard', compact('landlord', 'properties'));
    }

    // ─── Show create form ───────────────────────────────────────────────────────
    public function create(): View
    {
        $landlord = Auth::user()->landlord;
        return view('landlord.property-create', compact('landlord'));
    }

    // ─── Store new property ─────────────────────────────────────────────────────
    public function store(Request $request): RedirectResponse
    {
        $landlord = Auth::user()->landlord;

        // Only verified landlords can submit properties
        if (! $landlord->isVerified()) {
            return back()->with('error', 'Your landlord account must be verified before you can list properties.');
        }

        // ── Validate ───────────────────────────────────────────────────────────
        $validated = $request->validate([
            'title'                => ['required', 'string', 'max:150'],
            'description'          => ['required', 'string', 'min:30', 'max:1000'],
            'type'                 => ['required', 'in:single_room,self_contain,flat,mini_flat,duplex'],
            'address'              => ['required', 'string', 'max:255'],
            'area'                 => ['required', 'string', 'max:100'],
            'distance_from_campus' => ['required', 'string', 'max:100'],
            'price_per_year'       => ['required', 'numeric', 'min:10000', 'max:2000000'],
            'rooms_available'      => ['required', 'integer', 'min:1', 'max:50'],
            'total_rooms'          => ['required', 'integer', 'min:1', 'max:50'],
            'cover_image'          => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'gallery_images'       => ['nullable', 'array', 'max:5'],
            'gallery_images.*'     => ['image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'has_electricity'      => ['boolean'],
            'has_water'            => ['boolean'],
            'has_security'         => ['boolean'],
            'is_furnished'         => ['boolean'],
            'allows_cooking'       => ['boolean'],
        ]);

        // ── Handle cover image upload ──────────────────────────────────────────
        $coverPath = $request->file('cover_image')
            ->store('properties/covers', 'public');

        // ── Handle gallery images upload ───────────────────────────────────────
        $galleryPaths = [];
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $img) {
                $galleryPaths[] = $img->store('properties/gallery', 'public');
            }
        }

        // ── Create property (defaults to status=pending) ───────────────────────
        Property::create([
            'landlord_id'          => $landlord->id,
            'title'                => $validated['title'],
            'description'          => $validated['description'],
            'type'                 => $validated['type'],
            'address'              => $validated['address'],
            'area'                 => $validated['area'],
            'distance_from_campus' => $validated['distance_from_campus'],
            'city'                 => 'Ikere-Ekiti',
            'state'                => 'Ekiti',
            'price_per_year'       => $validated['price_per_year'],
            'rooms_available'      => $validated['rooms_available'],
            'total_rooms'          => $validated['total_rooms'],
            'status'               => 'pending',   // always pending until admin approves
            'has_electricity'      => $request->boolean('has_electricity'),
            'has_water'            => $request->boolean('has_water'),
            'has_security'         => $request->boolean('has_security'),
            'is_furnished'         => $request->boolean('is_furnished'),
            'allows_cooking'       => $request->boolean('allows_cooking'),
            'cover_image'          => $coverPath,
            'gallery_images'       => $galleryPaths ?: null,
            'gallery_count'        => count($galleryPaths),
        ]);

        return redirect()
            ->route('landlord.dashboard')
            ->with('success', '🏠 Your property has been submitted and is awaiting admin verification.');
    }

    // ─── Show single property detail (for landlord) ────────────────────────────
    public function show(Property $property): View
    {
        $this->authorizeProperty($property);
        return view('landlord.property-show', compact('property'));
    }

    // ─── Delete a pending property ──────────────────────────────────────────────
    public function destroy(Property $property): RedirectResponse
    {
        $this->authorizeProperty($property);

        // Only allow deletion of pending/rejected properties
        if ($property->status === 'approved') {
            return back()->with('error', 'Approved properties cannot be deleted. Contact admin.');
        }

        // Delete uploaded images
        if ($property->cover_image) {
            Storage::disk('public')->delete($property->cover_image);
        }
        foreach ($property->gallery_images ?? [] as $img) {
            Storage::disk('public')->delete($img);
        }

        $property->delete();

        return redirect()->route('landlord.dashboard')
            ->with('success', 'Property deleted successfully.');
    }

    // ─── Helper: ensure the authenticated landlord owns the property ────────────
    private function authorizeProperty(Property $property): void
    {
        $landlordId = Auth::user()->landlord->id;
        if ($property->landlord_id !== $landlordId) {
            abort(403, 'You do not have permission to access this property.');
        }
    }
}
