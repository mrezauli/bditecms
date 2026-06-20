<?php

namespace App\Models;

use Database\Factories\DistrictFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\ModelStatus\HasStatuses;

class District extends Model
{
    /** @use HasFactory<DistrictFactory> */
    use HasFactory, HasStatuses, SoftDeletes;
}
