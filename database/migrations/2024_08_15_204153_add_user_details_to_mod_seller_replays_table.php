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
        Schema::table('mod_seller_replays', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->after('id');
            $table->string('username', 255)->after('user_id');
            $table->string('avatar', 255)->nullable()->after('username');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mod_seller_replays', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('username');
            $table->dropColumn('avatar');
        });
    }
};
