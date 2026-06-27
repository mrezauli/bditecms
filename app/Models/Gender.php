<?php

namespace App\Models;

use Database\Factories\GenderFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\ModelStatus\HasStatuses;

#[Fillable(['name'])]
class Gender extends Model
{
    /** @use HasFactory<GenderFactory> */
    use HasFactory, HasStatuses, SoftDeletes;

    public function profiles(): HasMany
    {
        return $this->hasMany(Profile::class);
    }
}
