<?php

namespace App\Models;

use Database\Factories\AnswerFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\ModelStatus\HasStatuses;

#[Fillable(['label', 'content', 'question_id'])]
class Answer extends Model
{
    /** @use HasFactory<AnswerFactory> */
    use HasFactory, HasStatuses, SoftDeletes;

    /**
     * Get the question that owns the Answer
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}