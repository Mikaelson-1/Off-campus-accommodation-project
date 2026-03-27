<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'classification',
    ];

    protected function casts(): array
    {
        return [
            'classification' => 'string',
        ];
    }

    // ─── Scopes ────────────────────────────────────────────────────────────────
    public function scopeCoreQuarters($query)
    {
        return $query->where('classification', 'core_quarter');
    }

    public function scopeWards($query)
    {
        return $query->where('classification', 'ward');
    }

    public function scopeNeighborhoods($query)
    {
        return $query->where('classification', 'neighborhood');
    }

    // ─── Helpers ───────────────────────────────────────────────────────────────
    public function classificationLabel(): string
    {
        return match($this->classification) {
            'core_quarter'   => 'Core Quarter',
            'ward'           => 'Ward',
            'neighborhood'   => 'Neighborhood',
            default          => ucfirst($this->classification),
        };
    }

    // ─── Relationships ─────────────────────────────────────────────────────────
    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}
