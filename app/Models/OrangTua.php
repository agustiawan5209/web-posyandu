<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrangTua extends Model
{
    use HasFactory;

    protected $table = 'orang_tuas';

    protected $fillable = [
        'nama',
        'alamat',
        'no_telpon',
    ];

    public function anak()
    {
        return $this->hasMany(Balita::class, 'org_tua_id', 'id'); // Asumsikan tabel 'anak'
    }
}
