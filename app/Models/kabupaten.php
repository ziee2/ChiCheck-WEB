<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'provinsi_id'];
    protected $table = 'kabupaten';
    protected $primarykey = 'id';

    
    public function Provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    public function Kecamatan()
    {
        return $this->hasMany(Kecamatan::class);
    
    }
    public function User() 
    {
        return $this->belongsTo(User::class);
    }
}
