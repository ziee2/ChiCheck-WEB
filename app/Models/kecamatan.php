<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kecamatan extends Model
{
    use HasFactory;
    protected $fillable = ['nama','kabupaten_id'];
    protected $table = 'kecamatan';
    protected $primarykey = 'id';

    public function kabupaten()
    {
        return $this->belongsTo(kabupaten::class);
    }

    public function desa()
    {
        return $this->hasMany(desa::class);
    
    }
    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
