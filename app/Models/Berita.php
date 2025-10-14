<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
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

            $original = $berita->getOriginal();

            if (
                isset($original['thumbnail']) &&
                $original['thumbnail'] !== $berita->thumbnail
            ) {
                Storage::disk('public')->delete($original['thumbnail']);
            }
        });

        static::deleting(function ($berita) {
            if ($berita->thumbnail) {
                Storage::disk('public')->delete($berita->thumbnail);
            }

            if ($berita->galeris) {
                foreach ($berita->galeris as $galeri) {
                    Storage::disk('public')->delete($galeri->gambar);
                }
                $berita->galeris()->delete();
            }
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
