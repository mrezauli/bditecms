<?php

namespace App\Models;

use Database\Factories\UniversityCategoryFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\ModelStatus\HasStatuses;

#[Fillable(['name'])]
class UniversityCategory extends Model
{
    /** @use HasFactory<UniversityCategoryFactory> */
    use HasFactory, HasStatuses, SoftDeletes;

    public function universities(): HasMany
    {
        return $this->hasMany(University::class);
    }
}
