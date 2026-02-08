<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tryout extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_tryout',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
    ];

    // Relasi ke hasil tryout (student results)
    public function results()
    {
        return $this->hasMany(TryoutResult::class);
    }

    // Relasi ke siswa yang mengikuti tryout
    public function students()
    {
        return $this->belongsToMany(Student::class, 'tryout_results')
                    ->withPivot('score', 'answers')
                    ->withTimestamps();
    }

  
    public function questions()
    {
        return $this->belongsToMany(Question::class, 'question_tryout', 'tryout_id', 'question_id');
    }
    


}
