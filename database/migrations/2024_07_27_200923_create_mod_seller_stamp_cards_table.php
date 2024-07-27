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
        Schema::create('mod_seller_stamp_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')->constrained('mod_shops')->onDelete('cascade'); // Verknüpft mit der Shops-Tabelle
            $table->boolean('is_active')->default(false);
            $table->timestamp('activated_at')->nullable();
            $table->boolean('is_renewed')->default(false);
            $table->integer('discount')->default(0); // Rabattbetrag
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mod_seller_stamp_cards');
    }
};
