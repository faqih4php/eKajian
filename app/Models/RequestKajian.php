<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestKajian extends Model
{
    protected $fillable = [
        'name',
        'tema_kajian',
        'lokasi',
        'nomer',
        'jabatan_id',
        'jenis_kajian_id',
        'waktu_kajian',
        'status'
    ];

    protected $casts = [
        'waktu_kajian' => 'datetime',
    ];

    protected $table = 'request_kajian';

    public function home()
    {
        return $this->hasOne(Home::class);
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }

    public function jenis_kajian()
    {
        return $this->belongsTo(JenisKajian::class);
    }

    public function jadwal_kajian()
    {
        return $this->hasOne(JenisKajian::class);
    }
}
