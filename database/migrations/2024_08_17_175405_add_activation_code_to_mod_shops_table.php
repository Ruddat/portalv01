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
            //
            $table->string('activation_code', 8)->nullable()->after('api_password');
            $table->string('activation_code_used', 8)->nullable()->after('activation_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mod_shops', function (Blueprint $table) {
            //
            $table->dropColumn('activation_code');
            $table->dropColumn('activation_code_used');
        });
    }
};
