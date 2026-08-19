<?php

use App\Models\Exam;
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
        Schema::table('intakes', function (Blueprint $table) {
            $table->foreignIdFor(Exam::class)->nullable()->constrained();
        });
    }

    public function down(): void
    {
        Schema::table('intakes', function (Blueprint $table) {
            $table->dropForeignIdFor(Exam::class);
        });
    }
};
