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
        Schema::create('mod_products_ingredients', function (Blueprint $table) {
            $table->id();
            $table->integer('parent');
            $table->integer('shop_id')->default(0);
            $table->string('code_nr');
            $table->string('sizes_category')->default('0');
            $table->integer('max_spices')->default(1);
            $table->double('base_price')->default(0);
            $table->text('title');
            $table->tinyInteger('count_as_extra')->default(1);
     //       $table->dateTime('date');
            $table->integer('ordering');
            $table->tinyInteger('published')->default(1);

            // Indexes
            $table->index('parent');

            // Foreign key constraints
            // $table->foreign('parent')->references('id')->on('mod_products'); // Uncomment this line if needed

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mod_product_ingredients');
    }
};
