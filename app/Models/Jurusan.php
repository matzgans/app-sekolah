<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Jurusan extends Model
{
    protected $table = 'jurusan';
    protected $fillable = [
        'nama_jurusan',
        'slug',
        'deskripsi',
        'logo_jurusan',
        'nama_kepala_jurusan',
    ];

    public static function booted()
    {
        static::creating(function ($jurusan) {
            $jurusan->slug = Str::slug($jurusan->nama_jurusan);
        });

        static::updating(function ($jurusan) {
            $jurusan->slug = Str::slug($jurusan->nama_jurusan);
        });
    }

    public function galeris()
    {
        return $this->morphMany(Galeri::class, 'galeriable');
    }
}
