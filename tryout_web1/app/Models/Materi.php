<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $fillable = ['judul', 'deskripsi', 'file_path', 'type', 'user_id', 'kategori_id'];

    public function kategori()
    {
        return $this->belongsTo(MateriKategori::class, 'kategori_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
