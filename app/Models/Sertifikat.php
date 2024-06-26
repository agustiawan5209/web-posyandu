<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    use HasFactory;

    protected $table = 'sertifikats';
    protected $fillable =[
        'balita_id',
        'nik',
        'nomor',
        'nama_balita',
        'tgl_lahir',
        'tempat_lahir',
        'jenkel',
        'nama_orang_tua',
        'alamat_orang_tua',
        'no_telpon_orang_tua',
        'file',
    ];
    protected $appends = [
        'file_url'
    ];

    public function fileUrl() : Attribute
    {
        return new Attribute(
            get: fn()=> asset('storage/'. $this->file),
        );
    }

    public function balita(){
        return $this->hasOne(Balita::class,'id', 'balita_id');
    }



    //  FIlter Data User
    public function scopeFilter($query, $filter)
    {
        $query->when($filter['search'] ?? null, function ($query, $search) {
            $query->where('nama_balita', 'like', '%' . $search . '%')
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
