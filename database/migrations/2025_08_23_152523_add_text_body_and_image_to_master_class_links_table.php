<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('master_class_links', function (Blueprint $table) {
        $table->longText('text_body')->nullable()->after('visible');
        $table->string('image')->nullable()->after('text_body');
    });
}

public function down()
{
    Schema::table('master_class_links', function (Blueprint $table) {
        $table->dropColumn(['text_body', 'image']);
    });
}

};
