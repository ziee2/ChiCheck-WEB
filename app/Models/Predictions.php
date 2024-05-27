<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\controllers\RiwayatPrediksiController;

class Predictions extends Model
{
    use HasFactory;
    protected $fillable = ['penyakit', 'deskripsi', 'solusi', 'img_url', 'user_id'];
    protected $table = 'predictions';
    protected $primarykey = 'id';

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
