<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrangTua extends Model
{
    use HasFactory;

    protected $table = 'orang_tuas';

    protected $fillable = [
        'nama',
        'user_id',
        'alamat',
        'no_telpon',
    ];

    public function balita()
    {
        return $this->hasMany(Balita::class, 'org_tua_id', 'id'); // Asumsikan tabel 'anak'
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    protected $casts = [];


    protected $appends = [
        'jumlah_anak',
    ];

    public function jumlahAnak(): Attribute
    {
        return new Attribute(
            get: fn () => $this->balita()->count(),
        );
    }




    //  FIlter Data User
    public function scopeFilter($query, $filter)
    {
        $query->when($filter['search'] ?? null, function ($query, $search) {
            $query->where('nama', 'like', '%' . $search . '%')
                ->orWhere('alamat', 'like', '%' . $search . '%')
                ->orWhere('no_telpon', 'like', '%' . $search . '%');
        })->when($filter['order'] ?? null, function ($query, $order) {
            $query->orderBy('id', $order);
        });
    }
}
