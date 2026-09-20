<?php

namespace App\Models;

use Database\Factories\IssueCategoryFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\ModelStatus\HasStatuses;

#[Fillable(['name'])]
class IssueCategory extends Model
{
    /** @use HasFactory<IssueCategoryFactory> */
    use HasFactory, HasStatuses, SoftDeletes;

    public function issues(): HasMany
    {
        return $this->hasMany(Issue::class);
    }
}
