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
        Schema::create('mod_seller_domains', function (Blueprint $table) {
            $table->id();
            $table->string('domain')->unique(); // Speichert die Domain wie "expresspeine.de" oder "www.expresspeine.de"
            $table->unsignedBigInteger('shop_id'); // Verweis auf die Shop-Tabelle
            $table->timestamps();

            // Fremdschlüssel auf Shops, um sicherzustellen, dass jede Domain einem Shop zugeordnet ist
            $table->foreign('shop_id')->references('id')->on('mod_shops')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mod_seller_domains');
    }
};
