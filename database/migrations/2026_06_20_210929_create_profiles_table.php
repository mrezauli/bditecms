<?php

use App\Models\District;
use App\Models\University;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->date('date_of_birth');
            $table->enum('gender', ['male', 'female']);
            $table->integer('mobile_number');
            $table->text('present_address');
            $table->integer('post_code');
            $table->foreignIdFor(District::class);
            $table->foreignIdFor(University::class);
            $table->string('occupation', 20);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
