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
        Schema::create('mod_additives', function (Blueprint $table) {
            $table->id();
            $table->integer('parent')->default(0);
            $table->string('additive_nr', 10);
            $table->string('additive_art', 255)->comment('Art');
            $table->string('additive_title', 255)->comment('auf der Speisekarte');
            $table->string('additive_slug')->unique()->nullable()->comment('Slug');
            $table->text('additive_description')->comment('Beispiele');
            $table->char('lang', 2)->default('en');
            $table->integer('ordering')->default(10000);
            $table->boolean('published')->default(true);
            $table->dateTime('additive_date');
            $table->string('additive_image')->nullable(); // Bildpfad NULL-Werte
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mod_additives');
    }
};
