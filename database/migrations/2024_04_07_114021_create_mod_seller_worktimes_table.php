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
        Schema::create('mod_seller_worktimes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shop_id');
            $table->foreign('shop_id')->references('id')->on('mod_shops')->onDelete('cascade');
            $table->string('day_of_week'); // Wochentag
            $table->time('open_time')->nullable(); // Öffnungszeit
            $table->time('close_time')->nullable(); // Schließzeit
            $table->boolean('is_open')->default(false); // Status des Öffnungsbuttons (geschlossen)
            // Weitere Spalten hier hinzufügen, falls benötigt
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mod_seller_worktimes');
    }
};
