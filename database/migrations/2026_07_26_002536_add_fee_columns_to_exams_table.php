<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('exams', function (Blueprint $table) {
            $table->decimal('ip_fee', 10, 2)->nullable()->after('details');
            $table->decimal('fe_full_fee', 10, 2)->nullable()->after('ip_fee');
            $table->decimal('fe_half_passer_fee', 10, 2)->nullable()->after('fe_full_fee');
        });
    }

    public function down(): void
    {
        Schema::table('exams', function (Blueprint $table) {
            $table->dropColumn(['ip_fee', 'fe_full_fee', 'fe_half_passer_fee']);
        });
    }
};
