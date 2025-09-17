<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    protected $table = 'berita';
    protected $fillable = [
        'judul',
        'isi_berita',
        'thumbnail',
        'slug',
        'user_id',
        'status',
        'tanggal_publikasi',
        'views',
    ];


    public static function booted()
    {
        static::creating(function ($berita) {
            $berita->slug = Str::slug($berita->judul);
            $berita->user_id = auth()->user()->id;
        });

        static::updating(function ($berita) {
            $berita->slug = Str::slug($berita->judul);
            $berita->user_id = auth()->user()->id;
        });
    }

    public function pembuat()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function galeris()
    {
        return $this->morphMany(Galeri::class, 'galeriable');
    }
}
