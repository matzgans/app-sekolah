<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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
            $original = $jurusan->getOriginal();
            if (isset($original['logo_jurusan']) && $original['logo_jurusan'] !== $jurusan->logo_jurusan) {
                Storage::disk('public')->delete($original['logo_jurusan']);
            }
        });

        static::deleting(function ($jurusan) {



            if ($jurusan->galeris) {
                foreach ($jurusan->galeris as $galeri) {
                    Storage::disk('public')->delete($galeri->gambar);
                }
                $jurusan->galeris()->delete();
            }
        });
    }

    public function galeris()
    {
        return $this->morphMany(Galeri::class, 'galeriable');
    }
}
