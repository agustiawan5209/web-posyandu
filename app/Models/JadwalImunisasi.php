<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalImunisasi extends Model
{
    use HasFactory;

    protected $table = 'jadwal_imunisasis';
    protected $fillable = [
        'posyandus_id',
        'usia',
        'tanggal',
        'jenis_imunisasi',
        'deskripsi',
        'penanggung_jawab',
        'tempat',
    ];

    protected $casts = [
        // 'tanggal'=> 'date',
    ];

    protected $appends = [
        'jadwal',
    ];

    public function jadwal() : Attribute
    {
        return new Attribute(
            get: fn ()=> Carbon::parse($this->tanggal)->format('j F Y'),
        );
    }

    //  FIlter Data User
    public function scopeFilter($query, $filter)
    {
        $query->when($filter['search'] ?? null, function ($query, $search) {
            $query->where('usia', 'like', '%' . $search . '%')
                ->orWhere('jenis_imunisasi', 'like', '%' . $search . '%')
                ->orWhereDate('tanggal', 'like', '%' . $search . '%')
                ->orWhere('penanggung_jawab', 'like', '%' . $search . '%');
        })->when($filter['order'] ?? null, function ($query, $order) {
            $query->orderBy('id', $order);
        });
    }
}
