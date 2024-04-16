<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class diseases_model extends Model
{
    use HasFactory;

    protected $table = 'diseases_models';

    protected $fillable = [
        'report_models_id',
        'name',
        'description',
        'solution',
    ];

    public function report(): BelongsTo
    {
        return $this->belongsTo(report_models::class, 'report_models_id');
    }
}





