<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PegawaiPosyandu extends Model
{
    use HasFactory;

    protected $table = 'pegawai_posyandus';
    protected $fillable = [
        'user_id',
        'jabatan',
        'nama',
        'no_telpon',
        'alamat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
