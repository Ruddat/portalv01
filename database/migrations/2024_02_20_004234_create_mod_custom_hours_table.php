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
        Schema::create('mod_custom_hours', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mod_shop_id');
            $table->date('custom_hours_date');
            $table->time('expiry_time');
            $table->timestamps();

            $table->foreign('mod_shop_id')->references('id')->on('mod_shops')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mod_custom_hours');
    }
};
