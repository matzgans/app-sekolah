<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Fasilitas extends Model
{
    protected $table = 'fasilitas';
    protected $fillable = [
        'nama_fasilitas',
        'deskripsi',
        'foto_fasilitas',
        'status',
        'created_by',
        'updated_by',
    ];

    public static function booted()
    {
        static::deleting(function ($fasilitas) {
            if ($fasilitas->foto_fasilitas) {
                Storage::disk('public')->delete($fasilitas->foto_fasilitas);
            }
        });

        static::updating(function ($fasilitas) {
            $original = $fasilitas->getOriginal();
            if (isset($original['foto_fasilitas']) && $original['foto_fasilitas'] !== $fasilitas->foto_fasilitas) {
                Storage::disk('public')->delete($original['foto_fasilitas']);
            }
        });
    }
}
