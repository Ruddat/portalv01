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
        Schema::create('mod_categories', function (Blueprint $table) {
            $table->id();
         //   $table->foreignId('shop_id')->constrained(); // Fremdschlüsselbeziehung zu 'shops'
            $table->foreignId('shop_id')->constrained('mod_shops'); // Fremdschlüsselbeziehung zu 'mod_shops'
            $table->string('category_name');
            $table->string('category_slug')->unique();
            $table->string('category_image')->default('default_image.jpg');
            $table->string('category_image_from_gallery')->nullable()->default('default_value');
            $table->integer('ordering')->default('100000');
            $table->boolean('show_in_list')->default(true)->comment('show category in header and in list');
            $table->boolean('published')->default(true);
            $table->integer('parent')->nullable()->default(null);
//            $table->string('title');
//            $table->text('description');
//            $table->string('image')->default('default_image.jpg');
//            $table->string('image_from_gallery')->nullable()->default('default_value');
//            $table->tinyInteger('count_as_extra')->default(1);
//            $table->string('permalink');
//            $table->dateTime('date');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mod_categories');
    }
};
