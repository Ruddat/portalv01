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
            $table->integer('parent');
 //           $table->foreignId('category_id')->constrained('categories'); // Fremdschlüsselbeziehung zu 'categories'
 //           $table->foreignId('shop_id')->constrained(); // Fremdschlüsselbeziehung zu 'shops'
            $table->foreignId('shop_id')->constrained('mod_shops'); // Fremdschlüsselbeziehung zu 'mod_shops'
            $table->foreignId('category_id')->constrained('mod_categories'); // Fremdschlüsselbeziehung zu 'categories'

            $table->string('code');
            $table->string('title');
            $table->text('anonce');
            $table->longText('body');
            $table->integer('amount')->default(0);
            $table->string('logo');
            $table->string('image')->default('default_image.jpg');
            $table->string('image_from_gallery')->nullable()->default('default_value');
            $table->integer('bottles_id')->default(0);
            $table->text('additives_ids');
            $table->string('permalink');
            $table->dateTime('date')->default(now());
            $table->integer('ordering');
            $table->tinyInteger('published');
            $table->tinyInteger('deleted')->default(0);
            $table->tinyInteger('featured')->default(0);
            $table->tinyInteger('show_in_list')->default(1)->comment('show product in list');
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
