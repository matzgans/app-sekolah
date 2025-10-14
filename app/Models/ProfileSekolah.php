<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProfileSekolah extends Model
{
    protected $table = 'profile_sekolah';
    protected $guarded = [];

    public function getFilamentName(): string
    {
        return 'Profile Sekolah';
    }

    protected static function boot()
    {
        parent::boot();

        // 🧹 Hapus file ketika data dihapus
        static::deleting(function ($model) {
            if ($model->foto_sekolah) {
                Storage::disk('public')->delete($model->foto_sekolah);
            }
            if ($model->foto_kepala_sekolah) {
                Storage::disk('public')->delete($model->foto_kepala_sekolah);
            }
            if ($model->logo_sekolah) {
                Storage::disk('public')->delete($model->logo_sekolah);
            }
        });

        // 🔁 Hapus file lama saat update dengan file baru
        static::updating(function ($model) {
            $original = $model->getOriginal();

            if (
                isset($original['foto_sekolah']) &&
                $original['foto_sekolah'] !== $model->foto_sekolah
            ) {
                Storage::disk('public')->delete($original['foto_sekolah']);
            }

            if (
                isset($original['foto_kepala_sekolah']) &&
                $original['foto_kepala_sekolah'] !== $model->foto_kepala_sekolah
            ) {
                Storage::disk('public')->delete($original['foto_kepala_sekolah']);
            }

            if (
                isset($original['logo_sekolah']) &&
                $original['logo_sekolah'] !== $model->logo_sekolah
            ) {
                Storage::disk('public')->delete($original['logo_sekolah']);
            }
        });
    }
}
