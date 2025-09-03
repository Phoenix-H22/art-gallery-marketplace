<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('banners', function (Blueprint $table) {
            // Drop the old content column
            $table->dropColumn('content');

            // Add new carousel-specific columns
            $table->string('subtitle')->after('title');
            $table->string('button_text')->after('subtitle');
            $table->string('button_url')->after('button_text');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('banners', function (Blueprint $table) {
            // Restore the old content column
            $table->text('content')->after('title');

            // Drop the new carousel-specific columns
            $table->dropColumn(['subtitle', 'button_text', 'button_url']);
        });
    }
};
