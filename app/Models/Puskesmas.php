<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puskesmas extends Model
{
    use HasFactory;
    protected $table = 'puskesmas';
    protected $fillable = [
        'nama_puskesmas',
        'kepala_puskesmas',
        'nip',
        'foto_profile' ,
        'alamat',
        'logo' ,
        'visi',
        'misi',
        'deskripsi',
    ];
}
