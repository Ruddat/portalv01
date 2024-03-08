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
            $table->foreignId('bottles_id')->nullable()->constrained('mod_bottles');
            $table->string('product_code')->nullable();
            $table->string('product_title');
            $table->text('product_anonce');
            $table->longText('product_description');
            $table->integer('product_amount')->default(0);
            $table->string('product_image')->nullable();
            $table->string('product_image_from_gallery')->nullable()->default('default_value');
            $table->string('additives_ids')->nullable();
            $table->string('allergens_ids')->nullable();
            $table->string('product_slug');
            $table->dateTime('product_date')->default(now());
            $table->integer('product_ordering')->default(100000);
            $table->boolean('produckt_show_in_list')->default(true);
            $table->boolean('product_published')->default(true);
            $table->tinyInteger('deleted')->default(0);
            $table->tinyInteger('product_featured')->default(0);
            $table->integer('product_parent')->nullable()->default(null);
            $table->timestamps();

            // Indizes hinzufügen
            $table->index('shop_id');
            $table->index('category_id');
            $table->index('bottles_id');
            $table->index('product_published');
            $table->index('product_slug');
            // Weitere Indizes hinzufügen, je nachdem, wie Sie auf die Daten zugreifen möchten
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
