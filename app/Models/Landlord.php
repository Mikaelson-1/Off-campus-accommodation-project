<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Landlord extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'business_name',
        'address',
        'city',
        'state',
        'verification_status',
        'id_document_path',
        'nin_number',
        'verified_at',
        'rejection_reason',
    ];

    /**
     * Attribute casts.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'verified_at' => 'datetime',
        ];
    }

    // ─── Scopes ────────────────────────────────────────────────────────────────

    /** Only verified landlords. */
    public function scopeVerified($query)
    {
        return $query->where('verification_status', 'verified');
    }

    /** Only pending landlords. */
    public function scopePending($query)
    {
        return $query->where('verification_status', 'pending');
    }

    // ─── Helpers ───────────────────────────────────────────────────────────────

    public function isVerified(): bool
    {
        return $this->verification_status === 'verified';
    }

    public function isPending(): bool
    {
        return $this->verification_status === 'pending';
    }

    public function isRejected(): bool
    {
        return $this->verification_status === 'rejected';
    }

    // ─── Relationships ─────────────────────────────────────────────────────────

    /**
     * Get the user account that owns this landlord profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all properties belonging to this landlord.
     */
    public function properties()
    {
        return $this->hasMany(Property::class, 'landlord_id');
    }
}
