<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\ModelStatus\HasStatuses;

#[Fillable(['name'])]
class UniversityCategory extends Model
{
    /** @use HasFactory<\Database\Factories\UniversityCategoryFactory> */
    use HasFactory, HasStatuses, SoftDeletes;
}
