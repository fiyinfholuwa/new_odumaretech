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
        Schema::create('question_replies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_forum_id')
                  ->constrained('question_forums') // ✅ reference the correct table
                  ->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('content');
            $table->integer('helpful_count')->default(0);
            $table->string('image')->nullable(); // Optional image upload
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_replies');
    }
};
