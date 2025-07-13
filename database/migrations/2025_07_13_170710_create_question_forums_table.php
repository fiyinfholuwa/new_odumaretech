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
        Schema::create('question_forums', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('content');
            $table->longText('attachment_path')->nullable();
            $table->string('category')->default('unsolved');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('views')->default(0);
            $table->unsignedInteger('reply_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_forums');
    }
};
