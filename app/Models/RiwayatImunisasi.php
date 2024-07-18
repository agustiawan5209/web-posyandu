<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RiwayatImunisasi extends Model
{
    use HasFactory;

    protected $table = 'riwayat_imunisasis';
    protected $fillable = [
        'posyandus_id',
        'balita_id',
        'data_imunisasi',
        'tanggal',
        'catatan',
        'jenis_imunisasi',
    ];

    protected $casts = [
        'data_imunisasi' => 'json',
    ];
    protected $appends = [
        'nama_anak',
        'usia_anak',
        'berat_anak',
        'jenkel_anak',
        'nama_orang_tua',
    ];

    // Relasi
    public function balita()
    {
        return $this->belongsTo(Balita::class, 'balita_id', 'id');
    }

    // Serialization

    public function namaAnak(): Attribute
    {
        return new Attribute(
            get: fn () => $this->data_imunisasi['nama_anak'],
        );
    }
    public function usiaAnak(): Attribute
    {
        return new Attribute(
            get: fn () => $this->data_imunisasi['usia_anak'],
        );
    }
    public function beratAnak(): Attribute
    {
        return new Attribute(
            get: fn () => $this->data_imunisasi['berat_badan'],
        );
    }
    public function jenkelAnak(): Attribute
    {
        return new Attribute(
            get: fn () => $this->data_imunisasi['jenis_kelamin'],
        );
    }
    public function namaOrangTua(): Attribute
    {
        return new Attribute(
            get: fn () => $this->data_imunisasi['nama_orang_tua'],
        );
    }

    //  FIlter Data User
    public function scopeFilter($query, $filter)
    {
        $query->when($filter['search'] ?? null, function ($query, $search) {
            $query->where('jenis_imunisasi', 'like', '%' . $search . '%')
                ->orWhereDate('tanggal', 'like', '%' . $search . '%')
                ->orWhere('catatan', 'like', '%' . $search . '%')
                ->orWhereJsonContains('data_imunisasi->nama_anak', $search)
                ->orWhereJsonContains('data_imunisasi->nama_orang_tua', $search)
                ->orWhereJsonContains('data_imunisasi->jenis_kelamin', $search)
                ->orWhereJsonContains('data_imunisasi->kesehatan', $search);
        })->when($filter['order'] ?? null, function ($query, $order) {
            $query->orderBy('id', $order);
        })->when(Auth::check() ? in_array('Orang Tua', Auth::user()->getRoleNames()->toArray()) ?? null : null, function ($query) {
            $query->whereHas('balita', function ($query) {
                $query->where('org_tua_id', '=', Auth::user()->orangtua->id);
            });
        });
    }
}
