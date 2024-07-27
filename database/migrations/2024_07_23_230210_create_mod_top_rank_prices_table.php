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
            $table->unsignedBigInteger('shop_id');
            $table->decimal('current_price', 8, 2);
            $table->decimal('lat', 10, 7);
            $table->decimal('lng', 10, 7);
            $table->integer('rank')->nullable();
            $table->integer('original_rank')->nullable();
            $table->string('calculated_coordinates')->nullable();
            $table->string('original_coordinates')->nullable();
            $table->timestamp('start_time');
            $table->timestamp('end_time');
            $table->boolean('notify_on_outbid')->default(false);
            $table->timestamps();
            $table->softDeletes(); // Fügt ein deleted_at Feld hinzu


            $table->foreign('shop_id')->references('id')->on('mod_shops')->onDelete('cascade');
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
