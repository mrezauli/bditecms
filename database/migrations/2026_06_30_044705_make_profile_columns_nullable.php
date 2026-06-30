<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'sqlite') {
            DB::statement('PRAGMA foreign_keys=off');

            Schema::table('profiles', function ($table) {
                $table->date('date_of_birth')->nullable()->change();
                $table->unsignedBigInteger('gender_id')->nullable()->change();
                $table->integer('mobile_number')->nullable()->change();
                $table->text('present_address')->nullable()->change();
                $table->text('work_address')->nullable()->change();
                $table->integer('post_code')->nullable()->change();
                $table->unsignedBigInteger('district_id')->nullable()->change();
                $table->unsignedBigInteger('university_id')->nullable()->change();
                $table->string('occupation', 20)->nullable()->change();
            });

            DB::statement('PRAGMA foreign_keys=on');
        } else {
            Schema::table('profiles', function ($table) {
                $table->date('date_of_birth')->nullable()->change();
                $table->foreignId('gender_id')->nullable()->change();
                $table->integer('mobile_number')->nullable()->change();
                $table->text('present_address')->nullable()->change();
                $table->text('work_address')->nullable()->change();
                $table->integer('post_code')->nullable()->change();
                $table->foreignId('district_id')->nullable()->change();
                $table->foreignId('university_id')->nullable()->change();
                $table->string('occupation', 20)->nullable()->change();
            });
        }
    }

    public function down(): void
    {
        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'sqlite') {
            DB::statement('PRAGMA foreign_keys=off');

            Schema::table('profiles', function ($table) {
                $table->date('date_of_birth')->nullable(false)->change();
                $table->unsignedBigInteger('gender_id')->nullable(false)->change();
                $table->integer('mobile_number')->nullable(false)->change();
                $table->text('present_address')->nullable(false)->change();
                $table->text('work_address')->nullable(false)->change();
                $table->integer('post_code')->nullable(false)->change();
                $table->unsignedBigInteger('district_id')->nullable(false)->change();
                $table->unsignedBigInteger('university_id')->nullable(false)->change();
                $table->string('occupation', 20)->nullable(false)->change();
            });

            DB::statement('PRAGMA foreign_keys=on');
        } else {
            Schema::table('profiles', function ($table) {
                $table->date('date_of_birth')->nullable(false)->change();
                $table->foreignId('gender_id')->nullable(false)->change();
                $table->integer('mobile_number')->nullable(false)->change();
                $table->text('present_address')->nullable(false)->change();
                $table->text('work_address')->nullable(false)->change();
                $table->integer('post_code')->nullable(false)->change();
                $table->foreignId('district_id')->nullable(false)->change();
                $table->foreignId('university_id')->nullable(false)->change();
                $table->string('occupation', 20)->nullable(false)->change();
            });
        }
    }
};
