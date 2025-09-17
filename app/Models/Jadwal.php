<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';
    protected $fillable = [
        'jadwalable_id',
        'jadwalable_type',
        'hari',
        'waktu',
        'tanggal',
    ];

    public function jadwalable()
    {
        return $this->morphTo();
    }
}
