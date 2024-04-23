<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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

    // reation
    public function orangTua()
    {
        return $this->hasOne(OrangTua::class, 'id', 'org_tua_id');
    }
    // reation
    public function riwayatImunisasis()
    {
        return $this->hasMany(RiwayatImunisasi::class, 'balita_id', 'id');
    }

    protected $appends = [
        'hitung_usia',
        'nama_orang_tua',

    ];

    public function hitungUsia(): Attribute
    {
        $dateNow = Carbon::now();
        $tglLahir = Carbon::parse($this->tgl_lahir);

        $ageInYears = $dateNow->diffInYears($tglLahir);
        $ageInMonths = $dateNow->diffInMonths($tglLahir) % 12;

        if ($ageInMonths == 0) {
            $ageInDays = 0;
        } else {

            $ageInDays = $dateNow->diffInDays($tglLahir) % $ageInMonths;
        }
        // dd($dateNow->diffInDays($tglLahir) % 0);
        return new Attribute(
            get: fn () => "Usia: {$ageInYears} Tahun, {$ageInMonths} Bulan, {$ageInDays} Hari",
        );
    }
    public function namaOrangTua(): Attribute
    {
        // dd($this->orangTua());
        return new Attribute(
            get: fn () => $this->orangTua->nama,
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

    //  FIlter Data User
    public function scopeFilter($query, $filter)
    {
        $query->when($filter['search'] ?? null, function ($query, $search) {
            $query->where('nama', 'like', '%' . $search . '%')
                ->orWhereDate('tgl_lahir', 'like', '%' . $search . '%')
                ->orWhere('jenkel', 'like', '%' . $search . '%')
                ->orWhereHas('orangTua', function ($query) use ($search) {
                    $query->where('nama', 'like', '%' . $search . '%');
                });
        })->when($filter['order'] ?? null, function ($query, $order) {
            $query->orderBy('id', $order);
        })->when(in_array('Orang Tua', Auth::user()->getRoleNames()->toArray()), function ($query) {
            $query->where('org_tua_id', '=', Auth::user()->orangtua->id);
        });
    }
}
