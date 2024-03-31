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
        Schema::create('mod_product_ingredients_nodes', function (Blueprint $table) {
            $table->id();
            $table->integer('parent')->comment('product id');
            $table->integer('shop_id')->default(0);
            $table->integer('ingredients_id')->default(0);
            $table->integer('free_ingredients')->default(0);
            $table->integer('min_ingredients')->default(0);
            $table->integer('max_ingredients')->default(0);
           // $table->dateTime('date');

            // Indexes
            $table->index('ingredients_id');
            $table->index('parent');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mod_product_ingredients_nodes');
    }
};
