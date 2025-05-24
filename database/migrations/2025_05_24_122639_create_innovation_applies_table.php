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
        Schema::create('innovation_applies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->string('gender', 255)->nullable();
            $table->text('topic')->nullable();
            $table->string('email', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('innovation_applies');
    }
};
