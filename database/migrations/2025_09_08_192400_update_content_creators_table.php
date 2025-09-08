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
        Schema::table('content_creators', function (Blueprint $table) {
            // 🔄 Replace full_name with first_name + last_name
            if (Schema::hasColumn('content_creators', 'full_name')) {
                $table->dropColumn('full_name');
            }

            if (!Schema::hasColumn('content_creators', 'first_name')) {
                $table->string('first_name', 100);
            }

            if (!Schema::hasColumn('content_creators', 'last_name')) {
                $table->string('last_name', 100);
            }

            // 🔄 Rename 'message' → 'description'
            if (Schema::hasColumn('content_creators', 'message')) {
                $table->renameColumn('message', 'description');
            }

            // 🆕 Add missing columns
            if (!Schema::hasColumn('content_creators', 'reference')) {
                $table->string('reference', 20)->unique();
            }

            if (!Schema::hasColumn('content_creators', 'status')) {
                $table->enum('status', ['pending', 'approved', 'rejected'])
                      ->default('pending');
            }

            if (!Schema::hasColumn('content_creators', 'sample_link')) {
                $table->string('sample_link')->nullable();
            }

        });
    }

    public function down(): void
    {
        Schema::table('content_creators', function (Blueprint $table) {
            // Rollback new columns
            if (Schema::hasColumn('content_creators', 'first_name')) {
                $table->dropColumn('first_name');
            }

            if (Schema::hasColumn('content_creators', 'last_name')) {
                $table->dropColumn('last_name');
            }

            if (Schema::hasColumn('content_creators', 'description')) {
                $table->renameColumn('description', 'message');
            }

            if (Schema::hasColumn('content_creators', 'reference')) {
                $table->dropColumn('reference');
            }

            if (Schema::hasColumn('content_creators', 'status')) {
                $table->dropColumn('status');
            }

            if (Schema::hasColumn('content_creators', 'sample_link')) {
                $table->dropColumn('sample_link');
            }

            // Restore full_name if removed
            if (!Schema::hasColumn('content_creators', 'full_name')) {
                $table->string('full_name');
            }

            // Reset email & phone
            $table->string('email')->change();
            $table->string('phone_number')->change();
        });
    }
};
