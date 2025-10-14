<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Ekstrakurikuler extends Model
{
    protected $table = 'ekstrakurikuler';
    protected $fillable = [
        'nama_ekskul',
        'nama_pembina',
        'deskripsi',
        'logo_ekskul',
    ];

    public static function booted()
    {
        static::deleting(function ($ekstrakurikuler) {
            if ($ekstrakurikuler->logo_ekskul) {
                Storage::disk('public')->delete($ekstrakurikuler->logo_ekskul);
            }
        });

        static::updating(function ($ekstrakurikuler) {
            $original = $ekstrakurikuler->getOriginal();
            if (isset($original['logo_ekskul']) && $original['logo_ekskul'] !== $ekstrakurikuler->logo_ekskul) {
                Storage::disk('public')->delete($original['logo_ekskul']);
            }
        });

        static::deleting(function ($ekstrakurikuler) {
            if ($ekstrakurikuler->logo_ekskul) {
                Storage::disk('public')->delete($ekstrakurikuler->logo_ekskul);
            }
        });
    }

    public function jadwals()
    {
        return $this->morphMany(Jadwal::class, 'jadwalable');
    }
}
