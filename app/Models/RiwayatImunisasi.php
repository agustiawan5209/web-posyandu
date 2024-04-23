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
            get: fn()=> $this->balita->nama,
        );
    }

    //  FIlter Data User
    public function scopeFilter($query, $filter)
    {
        $query->when($filter['search'] ?? null, function ($query, $search) {
            $query->WhereDate('tanggal', 'like', '%' . $search . '%')
            ->orWhere('catatan', 'like',  '%' . $search . '%')
            ->orWhere('data_imunisasi', 'like', '%"nama_anak": "'. $search .'"%')
            ->orWhere('data_imunisasi', 'like', '%"nama_orang_tua": "'. $search .'"%')
            ->orWhere('data_imunisasi', 'like', '%"jenis_kelamin": "'. $search .'"%')
            ->orWhere('data_imunisasi', 'like', '%"usia_anak": "'. $search .'"%');
        })->when($filter['order'] ?? null, function ($query, $order) {
            $query->orderBy('id', $order);
        })->when(in_array('Orang Tua', Auth::user()->getRoleNames()->toArray()), function ($query) {
            $query->whereHas('balita', function($query){
                $query->where('org_tua_id', '=', Auth::user()->orangtua->id);
            });
        });
    }
}
