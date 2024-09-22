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
            $table->string('state')->nullable()->after('city');
            $table->string('ISO3166-2-lvl4')->nullable()->after('state');
            $table->string('country')->nullable()->after('ISO3166-2-lvl4');
            $table->string('country_code', 2)->nullable()->after('country');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mod_shops', function (Blueprint $table) {
            $table->dropColumn(['state', 'ISO3166-2-lvl4', 'country', 'country_code']);
        });
    }
};
