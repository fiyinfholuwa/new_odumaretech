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
        Schema::create('master_class_links', function (Blueprint $table) {
            $table->id();
            $table->text('link')->nullable();
            $table->text('date')->nullable();
            $table->text('time')->nullable();
            $table->text('title')->nullable();
            $table->text('visible')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_class_links');
    }
};
