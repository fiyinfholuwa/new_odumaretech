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
        Schema::table('master_class_links', function (Blueprint $table) {
            $table->text('text_body_2')->nullable()->after('visible');
            $table->string('masterclass_image')->nullable()->after('text_body_2');
        });
    }

    public function down(): void
    {
        Schema::table('master_class_links', function (Blueprint $table) {
            $table->dropColumn(['text_body_2', 'masterclass_image']);
        });
    }
};
