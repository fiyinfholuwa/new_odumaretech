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
        Schema::create('instructor_chats', function (Blueprint $table) {
            $table->id();
            $table->string('user_id', 10)->nullable();
            $table->string('name', 255)->nullable();
            $table->text('instructor_message')->nullable();
            $table->text('admin_message')->nullable();
            $table->string('instructor_status', 20)->nullable();
            $table->string('admin_status', 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructor_chats');
    }
};
