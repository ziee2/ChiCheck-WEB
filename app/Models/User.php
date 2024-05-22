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
        'level'
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
        $locationParts = [];

        if ($this->desa) {
            $locationParts[] = $this->desa->name;
        }
        if ($this->kecamatan) {
            $locationParts[] = $this->kecamatan->name;
        }
        if ($this->kabupaten) {
            $locationParts[] = $this->kabupaten->name;
        }
        if ($this->provinsi) {
            $locationParts[] = $this->provinsi->name;
        }

        return implode(', ', $locationParts);
    }

}
