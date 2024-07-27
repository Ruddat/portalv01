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
        Schema::table('mod_orders', function (Blueprint $table) {
            //
            $table->decimal('came_from_sponsored', 10, 2)->default(0)->after('eshop_discount');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mod_orders', function (Blueprint $table) {
            //
            $table->dropColumn('came_from_sponsored');
        });
    }
};
