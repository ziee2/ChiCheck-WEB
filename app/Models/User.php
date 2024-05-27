<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'username',
        'password',
        'image',
        'email',
        'no_hp',
        'desa_id',
        'kecamatan_id',
        'kabupaten_id',
        'provinsi_id',
        'password_confirmation',
        'status',
        'level',
        'terakhir_login',
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        // 'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
    
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class);
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    // Accessor for location
    public function getLocationAttribute()
    {
        $Alamat = [];

        if ($this->desa) {
            $Alamat[] = $this->desa->nama;
        }
        if ($this->kecamatan) {
            $Alamat[] = $this->kecamatan->nama;
        }
        if ($this->kabupaten) {
            $Alamat[] = $this->kabupaten->nama;
        }
        if ($this->provinsi) {
            $Alamat[] = $this->provinsi->nama;
        }

        return implode(', ', $Alamat);
    }

}
