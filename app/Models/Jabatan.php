<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $fillable = [
        'name'
    ];

    public function requestKajian() {
        return $this->hasMany(RequestKajian::class);
    }

    public function jadwalKajian() {
        return $this->hasMany(JadwalKajian::class);
    }
}
