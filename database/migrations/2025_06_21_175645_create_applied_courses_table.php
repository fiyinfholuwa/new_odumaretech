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
        Schema::create('applied_courses', function (Blueprint $table) {
            $table->id();
            $table->string('user_id', 10)->nullable();
            $table->string('course_id', 10)->nullable();
            $table->string('cohort_id', 10)->nullable();
            $table->string('payment_type', 50)->nullable();
            $table->string('status')->default("pending");
            $table->string('payment_id', 50)->nullable();

            $table->string('admission_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applied_courses');
    }
};
