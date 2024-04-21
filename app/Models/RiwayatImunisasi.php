<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatImunisasi extends Model
{
    use HasFactory;

    protected $table = 'riwayat_imunisasis';
    protected $fillable = [
        'balita_id',
        'data',
        'tanggal',
        'catatan',
    ];

    protected $casts = [
        'data' => 'json',
    ];

    // Relasi
    public function balita()
    {
        return $this->belongsTo(Balita::class, 'balita_id', 'id');
    }

     //  FIlter Data User
     public function scopeFilter($query, $filter)
     {
         $query->when($filter['search'] ?? null, function ($query, $search) {
             $query->WhereHas('balita', function($query)use($search){
                $query->where('nama', 'like', '%' . $search . '%');
             });
         })->when($filter['order'] ?? null, function ($query, $order) {
             $query->orderBy('id', $order);
         });
     }
}
