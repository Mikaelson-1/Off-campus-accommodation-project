<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Property;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the public home page with featured properties.
     */
    public function index(Request $request)
    {
        // Featured: 3 most recently approved properties
        $featured = Property::approved()
            ->with('landlord.user', 'location')
            ->latest('approved_at')
            ->take(3)
            ->get();

        // Get all locations grouped by classification
        $locations = Location::orderBy('classification')->orderBy('name')->get();

        return view('home', compact('featured', 'locations'));
    }

    /**
     * Handle the quick search from the hero section.
     */
    public function search(Request $request)
    {
        $query     = $request->input('q', '');
        $area      = $request->input('area', '');
        $type      = $request->input('type', '');
        $maxPrice  = $request->input('max_price', '');
        $locationId = $request->input('location_id', '');

        $properties = Property::approved()
            ->with('landlord.user', 'location')
            ->when($locationId, fn($q) => $q->inLocation($locationId))
            ->when($area, fn($q) => $q->inArea($area))
            ->when($query, fn($q) => $q->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('address', 'like', "%{$query}%")
                  ->orWhere('area', 'like', "%{$query}%");
            }))
            ->when($type, fn($q) => $q->where('type', $type))
            ->when($maxPrice, fn($q) => $q->where('price_per_year', '<=', $maxPrice))
            ->latest('approved_at')
            ->paginate(9);

        // Get all locations for the filter dropdown
        $locations = Location::orderBy('classification')->orderBy('name')->get();

        return view('search', compact('properties', 'query', 'area', 'type', 'maxPrice', 'locations', 'locationId'));
    }
}
