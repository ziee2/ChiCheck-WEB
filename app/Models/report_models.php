<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class report_models extends Model
{
    use HasFactory;
    protected $table = 'report_models';

    protected $fillable = [
        'user_id',
        'report_data',
    ];

    public function reportDiseases(): HasMany
    {
        return $this->hasMany(report_models::class);
    }
}
