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
            $table->foreignId('shop_id')->constrained('mod_shops'); // Fremdschlüsselbeziehung zu 'mod_shops'
            $table->integer('sizes_category')->nullable(); // ohne Anführungszeichen für numerische Standardwerte
            $table->string('category_name');
            $table->string('category_slug')->unique();
            $table->string('category_image')->default('default_image.jpg');
            $table->string('category_image_from_gallery')->nullable()->default('default_value');
            $table->text('category_description')->nullable();
            $table->integer('ordering')->default(100000); // ohne Anführungszeichen für numerische Standardwerte
            $table->boolean('show_in_list')->default(true)->comment('show category in header and in list');
            $table->boolean('published')->default(true);
            $table->unsignedBigInteger('parent')->nullable(); // Anstatt 'parent' verwenden wir 'unsignedBigInteger' für den Fremdschlüssel
            $table->foreign('parent')->references('id')->on('mod_categories')->onDelete('set null'); // Fremdschlüsselbeziehung zu sich selbst für die Elternkategorie
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
