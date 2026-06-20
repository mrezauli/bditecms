<?php

namespace App\Models;

use Database\Factories\UniversityFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\ModelStatus\HasStatuses;

class University extends Model
{
    /** @use HasFactory<UniversityFactory> */
    use HasFactory, HasStatuses, SoftDeletes;
}
