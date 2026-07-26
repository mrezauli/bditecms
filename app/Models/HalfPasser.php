<?php

namespace App\Models;

use Database\Factories\HalfPasserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HalfPasser extends Model
{
    /** @use HasFactory<HalfPasserFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'examinee_no',
        'name',
        'exam_type',
        'remarks',
    ];
}
