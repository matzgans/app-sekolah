<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Guru extends Model
{
    protected $table = 'guru';
    protected $fillable = [
        'nama_guru',
        'nip',
        'jabatan',
        'foto_guru',
        'slug',
        'instagram',
        'facebook',
        'twitter',
    ];

    public static function booted()
    {
        static::creating(function ($guru) {
            $guru->slug = Str::slug($guru->nama_guru);
        });

        static::updating(function ($guru) {
            $guru->slug = Str::slug($guru->nama_guru);
        });

        static::deleting(function ($guru) {
            if ($guru->foto_guru) {
                Storage::disk('public')->delete($guru->foto_guru);
            }
        });
    }
}
