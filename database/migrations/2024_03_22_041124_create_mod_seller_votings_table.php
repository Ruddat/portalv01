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
        Schema::create('mod_seller_votings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shop_id');
            $table->unsignedBigInteger('order_id');
            $table->string('order_hash');
            $table->unsignedTinyInteger('food_quality')->nullable();
            $table->unsignedTinyInteger('service')->nullable();
            $table->unsignedTinyInteger('punctuality')->nullable();
            $table->unsignedTinyInteger('price')->nullable();
            $table->string('review_title')->nullable();
            $table->text('review_content')->nullable();
            $table->string('photo_path')->nullable();
            $table->boolean('agb_accepted')->default(false);
            $table->boolean('published')->default(false);
            $table->timestamps();








            $table->foreign('shop_id')->references('id')->on('shops');
            // Falls du eine Tabelle 'shops' für die Zuordnung von Shop-IDs hast, ansonsten kannst du sie ändern
            // oder falls keine Zuordnung benötigt wird, kannst du diese Zeile löschen
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mod_seller_votings');
    }
};
