<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalKajian extends Model
{
    protected $fillable = [
        'request_kajian_id',
        'name',
        'tema_kajian',
        'lokasi',
        'jenis_kajian_id',
        'waktu_kajian'
    ];

    protected $table = 'jadwal_kajian';

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }

    public function jenis_kajian()
    {
        return $this->belongsTo(JenisKajian::class, 'jenis_kajian_id');
    }

    public function requestKajian()
    {
        return $this->belongsTo(RequestKajian::class, 'request_kajian_id');
    }

}
