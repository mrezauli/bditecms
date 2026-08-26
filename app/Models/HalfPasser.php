<?php

namespace App\Models;

use Database\Factories\HalfPasserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\ModelStatus\HasStatuses;

class HalfPasser extends Model
{
    /** @use HasFactory<HalfPasserFactory> */
    use HasFactory, HasStatuses, SoftDeletes;

    protected $fillable = [
        'examinee_no',
        'name',
        'type_id',
        'intake_id',
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function intake(): BelongsTo
    {
        return $this->belongsTo(Intake::class);
    }
}
