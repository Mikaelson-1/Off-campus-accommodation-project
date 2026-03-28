<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Landlord;
use App\Models\Property;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    // ─── Main Dashboard ─────────────────────────────────────────────────────────
    public function dashboard(): View
    {
        $stats = [
            'total_properties'  => Property::count(),
            'pending'           => Property::where('status', 'pending')->count(),
            'approved'          => Property::where('status', 'approved')->count(),
            'rejected'          => Property::where('status', 'rejected')->count(),
            'total_users'       => User::count(),
            'total_students'    => User::where('role', 'student')->count(),
            'total_landlords'   => User::where('role', 'landlord')->count(),
            'pending_landlords' => Landlord::where('verification_status', 'pending')->count(),
        ];

        // 5 most recent pending properties for the dashboard overview
        $pendingProperties = Property::with('landlord.user')
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'pendingProperties'));
    }

    // ─── All Properties (with filter) ───────────────────────────────────────────
    public function properties(Request $request): View
    {
        $status = $request->input('status', 'pending');
        $search = $request->input('q', '');

        $query = Property::with('landlord.user')->latest();

        if ($status !== 'all') {
            $query->where('status', $status);
        }
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('area', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%");
            });
        }

        $properties = $query->paginate(15)->withQueryString();

        $counts = [
            'pending'  => Property::where('status', 'pending')->count(),
            'approved' => Property::where('status', 'approved')->count(),
            'rejected' => Property::where('status', 'rejected')->count(),
            'all'      => Property::count(),
        ];

        return view('admin.properties', compact('properties', 'status', 'search', 'counts'));
    }

    // ─── View single property ────────────────────────────────────────────────────
    public function propertyDetail(Property $property): View
    {
        $property->load('landlord.user');
        return view('admin.property-detail', compact('property'));
    }

    // ─── Approve property ────────────────────────────────────────────────────────
    public function approveProperty(Property $property): RedirectResponse
    {
        $property->update([
            'status'      => 'approved',
            'approved_at' => now(),
        ]);

        return back()->with('success',
            " \"{$property->title}\" has been approved and is now live for students."
        );
    }

    // ─── Reject property ─────────────────────────────────────────────────────────
    public function rejectProperty(Request $request, Property $property): RedirectResponse
    {
        $request->validate([
            'rejection_reason' => ['nullable', 'string', 'max:500'],
        ]);

        $property->update([
            'status'           => 'rejected',
            'approved_at'      => null,
        ]);

        return back()->with('success',
            "The listing \"{$property->title}\" has been rejected."
        );
    }

    // ─── All Landlords ───────────────────────────────────────────────────────────
    public function landlords(Request $request): View
    {
        $status = $request->input('status', 'pending');
        $search = $request->input('q', '');

        $query = Landlord::with('user')->latest();

        if ($status !== 'all') {
            $query->where('verification_status', $status);
        }
        if ($search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $landlords = $query->paginate(15)->withQueryString();

        $counts = [
            'pending'  => Landlord::where('verification_status', 'pending')->count(),
            'verified' => Landlord::where('verification_status', 'verified')->count(),
            'rejected' => Landlord::where('verification_status', 'rejected')->count(),
            'all'      => Landlord::count(),
        ];

        return view('admin.landlords', compact('landlords', 'status', 'search', 'counts'));
    }

    // ─── Verify landlord ─────────────────────────────────────────────────────────
    public function verifyLandlord(Landlord $landlord): RedirectResponse
    {
        $landlord->update([
            'verification_status' => 'verified',
            'verified_at'         => now(),
        ]);

        return back()->with('success',
            " {$landlord->user->name}'s account has been verified."
        );
    }

    // ─── Reject landlord ─────────────────────────────────────────────────────────
    public function rejectLandlord(Request $request, Landlord $landlord): RedirectResponse
    {
        $request->validate([
            'rejection_reason' => ['nullable', 'string', 'max:500'],
        ]);

        $landlord->update([
            'verification_status' => 'rejected',
            'rejection_reason'    => $request->input('rejection_reason', 'Your documents did not meet verification requirements.'),
        ]);

        return back()->with('success',
            "{$landlord->user->name}'s landlord account has been rejected."
        );
    }

    // ─── All Users ───────────────────────────────────────────────────────────────
    public function users(Request $request): View
    {
        $role   = $request->input('role', 'all');
        $search = $request->input('q', '');

        $query = User::with(['student', 'landlord'])->latest();

        if ($role !== 'all') {
            $query->where('role', $role);
        }
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->paginate(20)->withQueryString();

        return view('admin.users', compact('users', 'role', 'search'));
    }
}
