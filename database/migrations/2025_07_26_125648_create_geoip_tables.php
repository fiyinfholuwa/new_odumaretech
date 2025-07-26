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
    Schema::create('geoip_locations', function (Blueprint $table) {
        $table->integer('geoname_id')->primary();
        $table->string('locale_code', 10)->nullable();
        $table->string('continent_code', 5)->nullable();
        $table->string('continent_name', 50)->nullable();
        $table->string('country_iso_code', 5)->nullable();
        $table->string('country_name', 100)->nullable();
    });

    Schema::create('geoip_blocks', function (Blueprint $table) {
        $table->string('network', 50)->primary();
        $table->integer('geoname_id')->nullable();
        $table->integer('registered_country_geoname_id')->nullable();
        $table->integer('represented_country_geoname_id')->nullable();
        $table->boolean('is_anonymous_proxy')->default(false);
        $table->boolean('is_satellite_provider')->default(false);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('geoip_tables');
    }
};
