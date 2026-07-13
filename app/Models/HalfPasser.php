<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HalfPasser extends Model
{
    protected $fillable = [
        'examinee_no',
        'name',
        'exam_type',
        'remarks',
    ];
}
