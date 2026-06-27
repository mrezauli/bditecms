<?php

namespace App\Models;

use Database\Factories\AnswerFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function firstAnswerEnrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class, 'first_answer_id');
    }

    public function secondAnswerEnrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class, 'second_answer_id');
    }

    public function thirdAnswerEnrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class, 'third_answer_id');
    }

    public function fourthAnswerEnrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class, 'fourth_answer_id');
    }

    public function fifthAnswerEnrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class, 'fifth_answer_id');
    }

    public function sixthAnswerEnrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class, 'sixth_answer_id');
    }

    public function seventhAnswerEnrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class, 'seventh_answer_id');
    }

    public function eighthAnswerEnrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class, 'eighth_answer_id');
    }

    public function ninthAnswerEnrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class, 'ninth_answer_id');
    }
}
