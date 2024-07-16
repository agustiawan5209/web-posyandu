<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // $guarded berisi array nama kolom yang tidak dapat diubah
    protected $guarded = [
        'password',
        'email_verified_at',
        'remember_token',
    ];


    public function orangtua()
    {
        return $this->hasOne(OrangTua::class, 'user_id', 'id');
    }
    public function staff()
    {
        return $this->hasOne(PegawaiPosyandu::class, 'user_id', 'id');
    }

    //  FIlter Data User
    public function scopeFilter($query, $search)
    {
        $query->when($search ?? null, function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('username', 'like', '%' . $search . '%');
        });
    }
}
