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
        Schema::create('submit_projects', function (Blueprint $table) {
            $table->id();
            $table->string('course_id', 10)->nullable();
            $table->string('user_id', 10)->nullable();
            $table->string('assessment_id', 10)->nullable();
            $table->text('image')->nullable();
            $table->text('link')->nullable();
            $table->string('status', 20)->nullable();
            $table->string('status_in', 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submit_projects');
    }
};
