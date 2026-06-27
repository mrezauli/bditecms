<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\ModelStatus\HasStatuses;

#[Fillable(['user_id', 'date_of_birth', 'gender_id', 'mobile_number', 'present_address', 'work_address', 'post_code', 'district_id', 'university_id', 'occupation'])]
class Profile extends Model
{
    /** @use HasFactory<\Database\Factories\ProfileFactory> */
    use HasFactory, HasStatuses, SoftDeletes;
}