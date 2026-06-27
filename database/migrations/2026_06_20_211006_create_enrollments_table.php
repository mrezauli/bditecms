<?php

use App\Models\Answer;
use App\Models\Exam;
use App\Models\Site;
use App\Models\Type;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Exam::class);
            $table->foreignIdFor(Type::class);
            $table->foreignIdFor(Site::class);
            $table->foreignIdFor(Answer::class, 'first_answer_id');
            $table->foreignIdFor(Answer::class, 'second_answer_id');
            $table->foreignIdFor(Answer::class, 'third_answer_id');
            $table->foreignIdFor(Answer::class, 'fourth_answer_id');
            $table->foreignIdFor(Answer::class, 'fifth_answer_id');
            $table->foreignIdFor(Answer::class, 'six_answer_id');
            $table->foreignIdFor(Answer::class, 'seven_answer_id');
            $table->foreignIdFor(Answer::class, 'eight_answer_id');
            $table->foreignIdFor(Answer::class, 'nine_answer_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
