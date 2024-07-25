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
        Schema::create('mod_top_rank_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')->constrained('mod_shops');
            $table->decimal('current_price', 8, 2);
            //$table->decimal('calculated_coordinates', 10, 7)->default(0.0);
            $table->string('calculated_coordinates')->nullable();
            $table->string('original_coordinates')->nullable();
            $table->timestamp('start_time');
            $table->timestamp('end_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mod_top_rank_prices');
    }
};
