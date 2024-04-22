<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatImunisasi extends Model
{
    use HasFactory;

    protected $table = 'riwayat_imunisasis';
    protected $fillable = [
        'balita_id',
        'data_imunisasi',
        'tanggal',
        'catatan',
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
            ->orWhereJsonContains('data_imunisasi->nama_orang_tua', 'like', '%' . $search . '%')
            ->orWhereJsonContains('data_imunisasi->usia_anak', 'like', '%' . $search . '%')
            ->orWhereJsonContains('data_imunisasi->jenkel', 'like', '%' . $search . '%')
            ->orWhereJsonContains('data_imunisasi->nama_anak', 'like', '%' . $search . '%');
        })->when($filter['order'] ?? null, function ($query, $order) {
            $query->orderBy('id', $order);
        });
    }
}