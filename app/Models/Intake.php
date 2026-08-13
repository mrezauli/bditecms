<?php

namespace App\Models;

use Database\Factories\IntakeFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\ModelStatus\HasStatuses;

#[Fillable(['name', 'exam_date', 'registration_starts_at', 'registration_ends_at', 'result_published_at'])]
class Intake extends Model
{
    /** @use HasFactory<IntakeFactory> */
    use HasFactory, HasStatuses, SoftDeletes;

    protected function casts(): array
    {
        return [
            'exam_date' => 'date:Y-m-d',
            'registration_starts_at' => 'datetime',
            'registration_ends_at' => 'datetime',
            'result_published_at' => 'datetime',
        ];
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    public function isRegistrationOpen(): bool
    {
        $now = now();

        return $now >= $this->registration_starts_at && $now <= $this->registration_ends_at;
    }

    public function scopeOpenForRegistration($query)
    {
        $now = now();

        return $query->where('registration_starts_at', '<=', $now)
            ->where('registration_ends_at', '>=', $now);
    }
}
