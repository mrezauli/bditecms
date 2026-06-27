<?php

namespace App\Models;

use Database\Factories\DistrictFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\ModelStatus\HasStatuses;

#[Fillable(['name', 'division_id'])]
class District extends Model
{
    /** @use HasFactory<DistrictFactory> */
    use HasFactory, HasStatuses, SoftDeletes;
}