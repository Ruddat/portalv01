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
        Schema::table('general_settings', function (Blueprint $table) {
            //
            $table->string('key')->unique()->nullable()->defaultValue('');
            $table->decimal('minimum_bid', 8, 2)->default(0.50);
            $table->decimal('minimum_bid_factor', 8, 2)->default(0.08);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('general_settings', function (Blueprint $table) {
            //
            $table->dropColumn('minimum_bid');
            $table->dropColumn('key');
            $table->dropColumn('minimum_bid_factor');

        });
    }
};
