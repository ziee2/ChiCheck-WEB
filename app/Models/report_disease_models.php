<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class report_disease_models extends Model
{
    use HasFactory;

    protected $guarded = [];

    use HasFactory;
    public function report(): BelongsTo
    {
        return $this->belongsTo(report_disease_models::class);
    }

    public function diseases() : BelongsTo {
        return $this->belongsTo (diseases_model::class, "disease_model_id", "id");
    }
}
