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
        Schema::create('mod_bottles', function (Blueprint $table) {
            $table->id();
            $table->integer('parent')->default(0);
            $table->string('bottles_title', 255);
            $table->double('bottles_value');
            $table->char('lang', 2)->default('de');
            $table->integer('ordering')->default(100000);
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
        Schema::dropIfExists('mod_bottles');
    }
};
