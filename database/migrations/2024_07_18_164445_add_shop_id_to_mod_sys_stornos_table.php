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
        Schema::table('mod_sys_stornos', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('shop_id')->nullable()->after('order_id');

            // Optionally, add a foreign key constraint
            $table->foreign('shop_id')->references('id')->on('mod_shops')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mod_sys_stornos', function (Blueprint $table) {
            //
            $table->dropForeign(['shop_id']);
            $table->dropColumn('shop_id');
        });
    }
};
