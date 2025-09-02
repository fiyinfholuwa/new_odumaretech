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
    Schema::table('company_trainings', function (Blueprint $table) {
        $table->string('course_name', 100)->nullable()->after('location');
    });
}

public function down()
{
    Schema::table('company_trainings', function (Blueprint $table) {
        $table->dropColumn('course_name');
    });
}

};
