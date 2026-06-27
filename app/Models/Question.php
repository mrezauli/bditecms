<?php

namespace App\Models;

use Database\Factories\QuestionFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\ModelStatus\HasStatuses;

#[Fillable(['label', 'content'])]
class Question extends Model
{
    /** @use HasFactory<QuestionFactory> */
    use HasFactory, HasStatuses, SoftDeletes;
}
