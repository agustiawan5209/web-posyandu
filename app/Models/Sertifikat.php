<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    use HasFactory;

    protected $table = 'sertifikats';
    protected $fillable =[
        'balita_id',
        'nik',
        'nama_anak',
        'tgl_lahir',
        'tempat_lahir',
        'jenkel',
        'nama_orang_tua',
        'alamat_orang_tua',
        'no_telpon_orang_tua',
        'file',
    ];

    public function balita(){
        return $this->belongsTo(Balita::class, 'id','balita_id');
    }



    //  FIlter Data User
    public function scopeFilter($query, $filter)
    {
        $query->when($filter['search'] ?? null, function ($query, $search) {
            $query->where('nama_anak', 'like', '%' . $search . '%')
                ->orWhere('tgl_lahir', 'like', '%' . $search . '%')
                ->orWhere('tempat_lahir', 'like', '%' . $search . '%')
                ->orWhere('jenkel', 'like', '%' . $search . '%')
                ->orWhere('nama_orang_tua', 'like', '%' . $search . '%')
                ->orWhere('alamat_orang_tua', 'like', '%' . $search . '%')
                ->orWhere('no_telpon_orang_tua', 'like', '%' . $search . '%');
        })->when($filter['order'] ?? null, function ($query, $order) {
            $query->orderBy('id', $order);
        });
    }
}
