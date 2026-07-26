<?php

use App\Models\Exam;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exam_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Exam::class)->constrained();
            $table->string('name', 100);
            $table->date('exam_date');
            $table->dateTime('registration_starts_at');
            $table->dateTime('registration_ends_at');
            $table->dateTime('result_published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_sessions');
    }
};
