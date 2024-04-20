<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Balita extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'tgl_lahir',
        'jenkel',
        'org_tua_id'
    ];

    protected $appends = [
        'hitung_usia',
    ];

    public function hitungUsia(): Attribute
    {
        $dateNow = Carbon::now();
        $tglLahir = Carbon::parse($this->tgl_lahir);
        $ageInYears = $dateNow->diffInYears($tglLahir);
        $ageInMonths = $dateNow->diffInMonths($tglLahir) % 12;
        $ageInDays = $dateNow->diffInDays($tglLahir) % $ageInMonths ;
        return new Attribute(
            get: fn () => "Usia: {$ageInYears} Tahun, {$ageInMonths} Bulan, {$ageInDays} Hari",
        );
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
