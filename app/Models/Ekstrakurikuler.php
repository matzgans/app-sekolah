<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ekstrakurikuler extends Model
{
    protected $table = 'ekstrakurikuler';
    protected $fillable = [
        'nama_ekskul',
        'nama_pembina',
        'deskripsi',
        'logo_ekskul',
    ];

    public function jadwals()
    {
        return $this->morphMany(Jadwal::class, 'jadwalable');
    }
}
