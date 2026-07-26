<?php

use App\Models\ExamSession;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('enrollments', function (Blueprint $table) {
            $table->foreignIdFor(ExamSession::class)->nullable()->after('user_id')->constrained();
        });
    }

    public function down(): void
    {
        Schema::table('enrollments', function (Blueprint $table) {
            $table->dropForeignIdFor(ExamSession::class);
            $table->dropColumn('exam_session_id');
        });
    }
};
