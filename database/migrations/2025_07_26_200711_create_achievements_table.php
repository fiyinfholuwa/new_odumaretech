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
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // e.g. "first_course", "coding_expert"
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('color')->default('primary');
            $table->string('icon')->nullable();
            $table->integer('points')->default(0);
            $table->integer('target')->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achievements');
    }
};
