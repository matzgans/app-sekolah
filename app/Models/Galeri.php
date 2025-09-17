<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $table = 'galeri';
    protected $fillable = [
        'gambar',
        'galeriable_id',
        'galeriable_type',
    ];

    public function galeriable()
    {
        return $this->morphTo();
    }
}
