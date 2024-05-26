<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PegawaiPosyandu extends Model
{
    use HasFactory;

    protected $table = 'pegawai_posyandus';
    protected $fillable = [
        'user_id',
        'posyandus_id',
        'jabatan',
        'nama',
        'no_telpon',
        'alamat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function posyandus()
    {
        return $this->belongsTo(Posyandu::class);
    }

     //  FIlter Data User
     public function scopeFilter($query, $filter)
     {
         $query->when($filter['search'] ?? null, function ($query, $search) {
             $query->where('jabatan', 'like', '%' . $search . '%')
                 ->orWhere('nama', 'like', '%' . $search . '%')
                 ->orWhere('no_telpon', 'like', '%' . $search . '%');
         })->when($filter['order'] ?? null, function ($query, $order) {
             $query->orderBy('id', $order);
         });
     }
}
