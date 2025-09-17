<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Prestasi extends Model
{
    protected $table = 'prestasi';
    protected $fillable = [
        'judul',
        'deskripsi',
        'tingkat',
        'tahun',
        'slug',
        'thumbnail',
    ];

    public static function booted()
    {
        static::creating(function ($prestasi) {
            $prestasi->slug = Str::slug($prestasi->judul);
        });

        static::updating(function ($prestasi) {
            $prestasi->slug = Str::slug($prestasi->judul);
        });
    }

    public function galeris()
    {
        return $this->morphMany(Galeri::class, 'galeriable');
    }
}
