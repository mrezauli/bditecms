<?php

namespace App\Models;

use Database\Factories\IssueMessageFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['issue_id', 'user_id', 'body'])]
class IssueMessage extends Model
{
    /** @use HasFactory<IssueMessageFactory> */
    use HasFactory, SoftDeletes;

    public function issue(): BelongsTo
    {
        return $this->belongsTo(Issue::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
