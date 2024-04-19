<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balita extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'tgl_lahir',
        'jenkel',
        'org_tua_id'
    ];

    public function hitungUsia()
    {
        // Implement the logic to calculate the age
    }

    public function hitungBBG()
    {
        // Implement the logic to calculate the BBG
    }

    public function hitungTB()
    {
        // Implement the logic to calculate the TB
    }

    public function grafikPertumbuhan()
    {
        // Implement the logic to generate the growth chart
    }
}
