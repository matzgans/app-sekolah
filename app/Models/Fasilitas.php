<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
