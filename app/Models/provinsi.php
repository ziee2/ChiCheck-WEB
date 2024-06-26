<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class provinsi extends Model
{
    use HasFactory;
    protected $fillable = ['nama'];
    protected $table = 'provinsi';
    protected $primarykey = 'id';

    public function kecamatan()
    {
        return $this->belongsTo(kecamatan::class);
    }
    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
