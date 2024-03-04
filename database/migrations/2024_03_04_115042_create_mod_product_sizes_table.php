<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mod_product_sizes', function (Blueprint $table) {
            $table->id();
          //  $table->increments('id');
          //  $table->integer('parent');
            $table->foreignId('shop_id')->constrained('mod_shops'); // Fremdschlüsselbeziehung zu 'mod_shops'
            $table->foreignId('product_id')->constrained('mod_products'); // Fremdschlüsselbeziehung zu 'mod_products'
            $table->integer('parent')->default(0)->comment('product_id');
         //   $table->integer('shop_id')->default(0);
            $table->string('title', 255);
            $table->dateTime('date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('ordering')->default(10000);
            $table->tinyInteger('published')->default(1);
            $table->tinyInteger('current')->default(0);
            $table->tinyInteger('display')->default(1)->comment('show or hide in frontend/notifications');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mod_product_sizes');
    }
};
