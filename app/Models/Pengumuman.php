<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';
    protected $fillable = [
        'judul',
        'deskripsi',
        'tipe',
        'gambar',
        'status',
        'user_id',
        'file_pengumuman',
        'link',
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

        static::deleting(function ($pengumuman) {
            if ($pengumuman->gambar) {
                Storage::disk('public')->delete($pengumuman->gambar);
            }
            if ($pengumuman->file_pengumuman) {
                Storage::disk('public')->delete($pengumuman->file_pengumuman);
            }
        });
    }

    public function pembuat()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function jadwals()
    {
        return $this->morphMany(Jadwal::class, 'jadwalable');
    }
}
