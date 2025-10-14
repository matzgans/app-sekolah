<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
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

        static::deleting(function ($prestasi) {
            if ($prestasi->thumbnail) {
                Storage::disk('public')->delete($prestasi->thumbnail);
            }

            if ($prestasi->galeris) {
                foreach ($prestasi->galeris as $galeri) {
                    Storage::disk('public')->delete($galeri->gambar);
                }
                $prestasi->galeris()->delete();
            }
        });
    }

    public function galeris()
    {
        return $this->morphMany(Galeri::class, 'galeriable');
    }
}
