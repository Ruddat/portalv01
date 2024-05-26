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
        Schema::table('mod_shops', function (Blueprint $table) {
            // Hinzufügen von Slug
            $table->text('shop_slug', 255)->nullable()->after('shop_nr');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mod_shops', function (Blueprint $table) {
            // Löschen von Slug
            $table->dropColumn('shop_slug');
        });
    }
};
