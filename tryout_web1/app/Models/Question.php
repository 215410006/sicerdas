<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['question_text', 'options', 'correct_answer','image', 'category_id'];

    protected $casts = [
        'options' => 'array',
    ];

    
    public function category()
    {
        return $this->belongsTo(QuestionCategory::class, 'category_id');
    }

    public function tryouts()
    {
        return $this->belongsToMany(Tryout::class);
    }

}
