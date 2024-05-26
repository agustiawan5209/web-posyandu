<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posyandu extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'alamat',
    ];


    protected $appends = [
        'jumlah_pegawai',
    ];

    public function kader()
    {
        return $this->hasMany(PegawaiPosyandu::class, 'posyandus_id', 'id');
    }


    public function jumlahPegawai(): Attribute
    {
        return new Attribute(
            get:fn() => $this->kader->count(),
        );
    }



    //  FIlter Data User
    public function scopeFilter($query, $filter)
    {
        $query->when($filter['search'] ?? null, function ($query, $search) {
            $query->where('nama', 'like', '%' . $search . '%')
                ->orWhere('alamat', 'like', '%' . $search . '%');
        })->when($filter['order'] ?? null, function ($query, $order) {
            $query->orderBy('id', $order);
        });
    }
}
