<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kabupaten extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'provinsi_id'];
    protected $table = 'kabupaten';
    protected $primarykey = 'id';

    
    public function provinsi()
    {
        return $this->belongsTo(provinsi::class);
    }

    public function kecamatan()
    {
        return $this->hasMany(kecamatan::class);
    
    }
    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
