<?php

namespace App\Models;

use Database\Factories\PaymentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    /** @use HasFactory<PaymentFactory> */
    use HasFactory;

    protected $fillable = [
        'enrollment_id',
        'user_id',
        'amount',
        'transaction_id',
        'val_id',
        'bank_tran_id',
        'status',
        'currency',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
        ];
    }

    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(Enrollment::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isComplete(): bool
    {
        return $this->status === 'Complete';
    }

    public function isPending(): bool
    {
        return $this->status === 'Pending';
    }
}
