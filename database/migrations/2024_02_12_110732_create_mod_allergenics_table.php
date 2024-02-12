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
        Schema::create('mod_allergenics', function (Blueprint $table) {
            $table->id();
            $table->integer('parent')->default(0);
            $table->string('short_title');
            $table->string('title', 1000);
            $table->char('lang', 2)->default('en');
            $table->integer('ordering');
            $table->boolean('published')->default(true);
            $table->dateTime('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mod_allergenics');
    }
};
