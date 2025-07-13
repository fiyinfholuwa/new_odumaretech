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
        Schema::table('replies', function (Blueprint $table) {
            $table->foreignId('thread_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('content');
            $table->integer('helpful_count')->default(0);
            $table->string('image')->nullable(); // Optional image upload
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('replies', function (Blueprint $table) {
            // Drop foreign keys first (optional safety for MySQL)
            $table->dropForeign(['thread_id']);
            $table->dropForeign(['user_id']);

            $table->dropColumn(['thread_id', 'user_id', 'content', 'image']);
        });
    }
};
