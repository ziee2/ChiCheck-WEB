<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\controllers\RiwayatPrediksiController;

class DataTelur extends Model
{
    use HasFactory;
    protected $fillable = ['stok', 'created_at', 'user_id'];
    protected $table = 'telur_tabel';
    protected $primarykey = 'id';

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

}


