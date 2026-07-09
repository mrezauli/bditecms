<?php

namespace App\Models;

use Database\Factories\ExamFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\ModelStatus\HasStatuses;

#[Fillable(['name', 'acronym', 'level', 'details'])]
class Exam extends Model
{
    /** @use HasFactory<ExamFactory> */
    use HasFactory, HasStatuses, SoftDeletes;

    public function types(): HasMany
    {
        return $this->hasMany(Type::class);
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    protected function label(): Attribute
    {
        return Attribute::make(
            get: fn () => "{$this->acronym} ({$this->level}: {$this->name})",
        );
    }
}
