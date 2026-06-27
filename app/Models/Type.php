<?php

namespace App\Models;

use Database\Factories\TypeFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\ModelStatus\HasStatuses;

#[Fillable(['name', 'exam_id'])]
class Type extends Model
{
    /** @use HasFactory<TypeFactory> */
    use HasFactory, HasStatuses, SoftDeletes;

    /**
     * Get the exam that owns the Type
     */
    public function exam(): BelongsTo
    {
        return $this->belongsTo(Exam::class);
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }
}
