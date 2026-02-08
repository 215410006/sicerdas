<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriKategori extends Model
{
    use HasFactory;

    protected $fillable = ['nama'];

    public function materis()
    {
        return $this->hasMany(Materi::class, 'kategori_id');
    }
}
