<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;
    protected $fillable = ['nama','kabupaten_id'];
    protected $table = 'kecamatan';
    protected $primarykey = 'id';

    public function Kabupaten()
    {
        return $this->belongsTo(Kabupaten::class);
    }

    public function desa()
    {
        return $this->hasMany(Desa::class);
    
    }
    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
