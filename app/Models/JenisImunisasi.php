<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisImunisasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'keterangan',
    ];


     //  FIlter Data User
     public function scopeFilter($query, $filter)
     {
         $query->when($filter['search'] ?? null, function ($query, $search) {
             $query->where('nama', 'like', '%' . $search . '%')
                 ->orWhere('keterangan', 'like', '%' . $search . '%');
         })->when($filter['order'] ?? null, function ($query, $order) {
             $query->orderBy('id', $order);
         });
     }
}
