<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'landlord_id', 'title', 'description', 'type',
        'address', 'area', 'distance_from_campus', 'city', 'state',
        'price_per_year', 'rooms_available', 'total_rooms',
        'status', 'has_electricity', 'has_water',
        'has_security', 'is_furnished', 'allows_cooking',
        'cover_image', 'gallery_images', 'gallery_count', 'approved_at',
    ];

    protected function casts(): array
    {
        return [
            'approved_at'     => 'datetime',
            'gallery_images'  => 'array',
            'has_electricity' => 'boolean',
            'has_water'       => 'boolean',
            'has_security'    => 'boolean',
            'is_furnished'    => 'boolean',
            'allows_cooking'  => 'boolean',
            'price_per_year'  => 'decimal:2',
        ];
    }

    // ─── Scopes ────────────────────────────────────────────────────────────────
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeInArea($query, string $area)
    {
        return $query->where('area', 'like', "%{$area}%");
    }

    // ─── Helpers ───────────────────────────────────────────────────────────────
    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    public function coverImageUrl(): string
    {
        return $this->cover_image
            ? asset('storage/' . $this->cover_image)
            : asset('images/hero-hostel.png');   // fallback to hero image
    }

    public function formattedPrice(): string
    {
        return '₦' . number_format($this->price_per_year, 0);
    }

    public function typeLabel(): string
    {
        return match($this->type) {
            'single_room'  => 'Single Room',
            'self_contain' => 'Self Contain',
            'flat'         => 'Flat',
            'mini_flat'    => 'Mini Flat',
            'duplex'       => 'Duplex',
            default        => ucfirst($this->type),
        };
    }

    public function galleryImageUrls(): array
    {
        $images = $this->gallery_images ?? [];
        return array_map(fn($path) => asset('storage/' . $path), $images);
    }

    public function statusLabel(): string
    {
        return match($this->status) {
            'pending'  => 'Pending Review',
            'approved' => 'Approved',
            'rejected' => 'Rejected',
            'archived' => 'Archived',
            default    => ucfirst($this->status),
        };
    }

    public function statusColor(): string
    {
        return match($this->status) {
            'approved' => '#00A553',
            'rejected' => '#e53e3e',
            'archived' => '#9ca3af',
            default    => '#d97706', // amber for pending
        };
    }

    // ─── Relationships ─────────────────────────────────────────────────────────
    public function landlord()
    {
        return $this->belongsTo(Landlord::class);
    }
}
