<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Galeri extends Model
{
    protected $table = 'galeri';
    protected $fillable = [
        'gambar',
        'galeriable_id',
        'galeriable_type',
    ];

    public static function booted()
    {
        static::deleting(function ($galeri) {
            if ($galeri->gambar) {
                Storage::disk('public')->delete($galeri->gambar);
            }
        });

        static::updating(function ($galeri) {
            $original = $galeri->getOriginal();
            if (isset($original['gambar']) && $original['gambar'] !== $galeri->gambar) {
                Storage::disk('public')->delete($original['gambar']);
            }
        });
    }

    public function galeriable()
    {
        return $this->morphTo();
    }
}
