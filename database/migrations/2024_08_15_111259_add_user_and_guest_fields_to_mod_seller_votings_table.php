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
        Schema::table('mod_seller_votings', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('order_id');
            $table->string('guest_name')->nullable()->after('user_id');
            $table->string('guest_avatar')->nullable()->after('guest_name');

            // Optional: Wenn `user_id` als Fremdschlüssel verwendet werden soll
            $table->foreign('user_id')->references('id')->on('clients')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mod_seller_votings', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
            $table->dropColumn('guest_name');
            $table->dropColumn('guest_avatar');
        });
    }
};
