<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TryoutResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'tryout_id',
        'student_id',
        'score',
        'answers',
    ];

    protected $casts = [
        'answers' => 'array',
    ];

    // Relasi ke tryout
    public function tryout()
    {
        return $this->belongsTo(Tryout::class);
    }

    // Relasi ke student
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    
}
