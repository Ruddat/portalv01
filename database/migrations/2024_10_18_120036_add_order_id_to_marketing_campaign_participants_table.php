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
        Schema::table('marketing_campaign_participants', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id')->nullable()->after('shop_id'); // Feld für order_id hinzufügen
            $table->foreign('order_id')->references('id')->on('mod_orders')->onDelete('set null'); // Fremdschlüssel zu mod_orders
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('marketing_campaign_participants', function (Blueprint $table) {
            $table->dropForeign(['order_id']); // Fremdschlüssel löschen
            $table->dropColumn('order_id'); // Spalte order_id löschen
        });
    }
};
