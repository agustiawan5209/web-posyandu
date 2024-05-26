<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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

    protected $appends = [
        'nama_posyandu',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function posyandus()
    {
        return $this->hasOne(Posyandu::class, 'id', 'posyandus_id');
    }


    public function namaPosyandu(): Attribute
    {
        return new Attribute(
            get: fn () => $this->posyandus()->first()->nama,
        );
    }

    //  FIlter Data User
    public function scopeFilter($query, $filter)
    {
        $query->when($filter['search'] ?? null, function ($query, $search) {
            $query->where('jabatan', 'like', '%' . $search . '%')
                ->orWhere('nama', 'like', '%' . $search . '%')
                ->orWhere('no_telpon', 'like', '%' . $search . '%')
                ->orWhereHas('posyandus', function ($query) use ($search) {
                    $query->where('nama', 'like', '%' . $search . '%');
                });
        })->when($filter['order'] ?? null, function ($query, $order) {
            $query->orderBy('id', $order);
        });
    }
}
