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
        Schema::create('innovations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->text('github')->nullable();
            $table->text('link')->nullable();
            $table->string('status', 50)->nullable();
            $table->string('start_date', 50)->nullable();
            $table->string('end_date', 50)->nullable();
            $table->string('duration', 50)->nullable();
            $table->text('description')->nullable();
            $table->text('requirement')->nullable();
            $table->text('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('innovations');
    }
};
