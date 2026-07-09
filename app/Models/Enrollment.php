<?php

namespace App\Models;

use Database\Factories\EnrollmentFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\ModelStatus\HasStatuses;

#[Fillable(['user_id', 'exam_id', 'type_id', 'site_id', 'first_answer_id', 'second_answer_id', 'third_answer_id', 'fourth_answer_id', 'fifth_answer_id', 'sixth_answer_id', 'seventh_answer_id', 'eighth_answer_id', 'ninth_answer_id', 'am_exam', 'pm_exam'])]
class Enrollment extends Model
{
    /** @use HasFactory<EnrollmentFactory> */
    use HasFactory, HasStatuses, SoftDeletes;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function exam(): BelongsTo
    {
        return $this->belongsTo(Exam::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }

    public function firstAnswer(): BelongsTo
    {
        return $this->belongsTo(Answer::class, 'first_answer_id');
    }

    public function secondAnswer(): BelongsTo
    {
        return $this->belongsTo(Answer::class, 'second_answer_id');
    }

    public function thirdAnswer(): BelongsTo
    {
        return $this->belongsTo(Answer::class, 'third_answer_id');
    }

    public function fourthAnswer(): BelongsTo
    {
        return $this->belongsTo(Answer::class, 'fourth_answer_id');
    }

    public function fifthAnswer(): BelongsTo
    {
        return $this->belongsTo(Answer::class, 'fifth_answer_id');
    }

    public function sixthAnswer(): BelongsTo
    {
        return $this->belongsTo(Answer::class, 'sixth_answer_id');
    }

    public function seventhAnswer(): BelongsTo
    {
        return $this->belongsTo(Answer::class, 'seventh_answer_id');
    }

    public function eighthAnswer(): BelongsTo
    {
        return $this->belongsTo(Answer::class, 'eighth_answer_id');
    }

    public function ninthAnswer(): BelongsTo
    {
        return $this->belongsTo(Answer::class, 'ninth_answer_id');
    }
}
