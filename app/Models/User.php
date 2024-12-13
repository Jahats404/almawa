<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
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

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id_role');
    }
    public function agen()
    {
        return $this->hasOne(Agen::class, 'user_id', 'id');
    }
    public function supervisor()
    {
        return $this->hasOne(Agen::class, 'supervisor_id');
    }
    public function jamaah()
    {
        return $this->hasOne(Jamaah::class, 'user_id', 'id');
    }
    public function paket()
    {
        return $this->hasMany(Paket::class, 'user_id', 'id');
    }
    public function detail_pembayaran_jamaah()
    {
        return $this->hasMany(DetailPembayaranJamaah::class, 'user_id','id');
    }
    public function validator()
    {
        return $this->hasMany(DetailPembayaranJamaah::class, 'validator_id','id');
    }
}