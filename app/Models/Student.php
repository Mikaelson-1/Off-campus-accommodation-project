<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'matriculation_number',
        'level',
        'department',
        'faculty',
        'gender',
        'date_of_birth',
        'home_address',
    ];

    /**
     * Attribute casts.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
        ];
    }

    // ─── Relationships ─────────────────────────────────────────────────────────

    /**
     * Get the user account that owns this student profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
