<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileSekolah extends Model
{

    public function getFilamentName(): string
    {
        return 'Profile Sekolah';
    }
    protected $table = 'profile_sekolah';
    protected $guarded = [];
}
