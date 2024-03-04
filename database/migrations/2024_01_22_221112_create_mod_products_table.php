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
        Schema::create('mod_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')->constrained('mod_shops');
            $table->foreignId('category_id')->constrained('mod_categories');
//            $table->foreignId('bottles_id')->constrained('mod_bottles')->nullable();
            $table->foreignId('bottles_id')->nullable()->constrained('mod_bottles');


            //    $table->foreignId('bottles_id')->constrained('mod_bottles')->nullable();
          //  $table->foreignId('additives_id')->constrained('mod_additives');
          //  $table->foreignId('allergens_id')->constrained('mod_allergens');
            $table->string('product_code')->nullable();  // article number
            $table->string('product_title'); // article title
            $table->text('product_anonce'); // product short description
            $table->longText('product_description'); // product description
            $table->integer('product_amount')->default(0);
            $table->string('product_image')->nullable();
            $table->string('product_image_from_gallery')->nullable()->default('default_value');
         //   $table->integer('bottles_id')->default(0);
          //  $table->text('additives_ids')->default('0'); // Änderung des Standardwerts von 0 zu '0'
            $table->string('additives_ids')->nullable();
            $table->string('allergens_ids')->nullable(); // Änderung des Standardwerts von 0 zu '0'
         //   $table->text('allergens_ids')->default('0'); // Änderung des Standardwerts von 0 zu '0'
            $table->string('product_slug');
            $table->dateTime('product_date')->default(now());
            $table->integer('product_ordering')->default(100000); // Änderung des Standardwerts von '100000' zu 100000
            $table->boolean('produckt_show_in_list')->default(true);
            $table->boolean('product_published')->default(true);
            $table->tinyInteger('deleted')->default(0);
            $table->tinyInteger('product_featured')->default(0);
            $table->integer('product_parent')->nullable()->default(null);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mod_products');
    }
};
