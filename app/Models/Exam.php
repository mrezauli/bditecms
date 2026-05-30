<?php

namespace App\Models;

use Database\Factories\ExamFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['name', 'acronym', 'level', 'details'])]
class Exam extends Model
{
    /** @use HasFactory<ExamFactory> */
    use HasFactory, SoftDeletes;
}
