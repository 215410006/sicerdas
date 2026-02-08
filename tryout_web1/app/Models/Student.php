<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model {
    use HasFactory;

    protected $fillable = [
        'name', 'email'
    ];

   

     // User.php
     public function attendance()
     {
         return $this->hasMany(Attendance::class);
     }

}


