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
        Schema::create('mod_top_rank_price_archiveds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')->constrained('mod_shops');
            $table->decimal('current_price', 8, 2);
            $table->decimal('lat', 10, 7);
            $table->decimal('lng', 10, 7);
            $table->integer('rank');
            $table->timestamp('start_time');
            $table->timestamp('end_time');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mod_top_rank_price_archiveds');
    }
};
