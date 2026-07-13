<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('half_passers', function (Blueprint $table) {
            $table->id();
            $table->string('examinee_no');
            $table->string('name');
            $table->string('exam_type');
            $table->string('remarks')->nullable();
            $table->timestamps();

            $table->unique(['examinee_no', 'exam_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('half_passers');
    }
};
