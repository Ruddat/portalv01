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
        Schema::create('mod_products_ingredients_prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent')->comment('ingredient_id'); // Ändern Sie ggf. den Datentyp auf unsignedBigInteger
            $table->integer('size_id')->default(0);
            $table->integer('shop_id')->default(0);
            $table->double('price')->default(0);
          //  $table->dateTime('date');

          $table->foreign('parent')->references('id')->on('mod_products_ingredients')->onDelete('cascade');


            // Indexes
            $table->index('parent');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mod_products_ingredients_prices');
    }
};
