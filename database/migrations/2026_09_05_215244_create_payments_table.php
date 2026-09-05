<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enrollment_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->decimal('amount', 10, 2);
            $table->string('transaction_id')->unique();
            $table->string('val_id')->nullable();
            $table->string('bank_tran_id')->nullable();
            $table->enum('status', ['Pending', 'Complete', 'Failed', 'Canceled'])->default('Pending');
            $table->string('currency', 10)->default('BDT');
            $table->timestamps();

            $table->index(['transaction_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
