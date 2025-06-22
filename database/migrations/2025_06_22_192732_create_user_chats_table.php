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
        Schema::create('user_chats', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->text('user_message')->nullable();
            $table->text('course_id')->nullable();
            $table->text('user_id')->nullable();
            $table->text('instructor_message')->nullable();
            $table->string('user_status', 20)->nullable();
            $table->string('instructor_status', 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_chats');
    }
};
