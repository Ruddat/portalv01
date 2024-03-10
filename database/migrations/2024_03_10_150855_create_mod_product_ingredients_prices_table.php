<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('mod_products_ingredients_prices', function (Blueprint $table) {
            $table->id();
            $table->integer('parent')->comment('ingridient_id');
            $table->integer('size_id')->default(0);
            $table->integer('shop_id')->default(0);
            $table->double('price')->default(0);
          //  $table->dateTime('date');

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
        Schema::dropIfExists('mod_product_ingredients_prices');
    }
};
