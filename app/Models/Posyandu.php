<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posyandu extends Model
{
    use HasFactory;

    protected $table = 'posyandus';
    protected $fillable = [
        'nama_posyandu',
        'alamat',
        'logo',
    ];
}
