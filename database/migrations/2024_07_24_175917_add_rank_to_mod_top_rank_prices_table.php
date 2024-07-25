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
        Schema::table('mod_top_rank_prices', function (Blueprint $table) {
            //
            $table->integer('rank')->nullable()->after('current_price');
            $table->double('lat', 10, 6)->nullable()->after('current_price');
            $table->double('lng', 10, 6)->nullable()->after('lat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mod_top_rank_prices', function (Blueprint $table) {
            //
            $table->dropColumn('rank');
            $table->dropColumn(['lat', 'lng']);

        });
    }
};
