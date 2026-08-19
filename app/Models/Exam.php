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

#[Fillable(['name', 'acronym', 'level', 'details', 'ip_fee', 'fe_full_fee', 'fe_half_passer_fee'])]
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

    public function intakes(): HasMany
    {
        return $this->hasMany(Intake::class);
    }

    public function currentIntake(): ?Intake
    {
        return $this->intakes()->get()->first(fn ($intake) => $intake->isRegistrationOpen());
    }

    protected function casts(): array
    {
        return [
            'ip_fee' => 'decimal:2',
            'fe_full_fee' => 'decimal:2',
            'fe_half_passer_fee' => 'decimal:2',
        ];
    }

    protected function label(): Attribute
    {
        return Attribute::make(
            get: fn () => "{$this->acronym} ({$this->level}: {$this->name})",
        );
    }
}
