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
        Schema::create('delivery_areas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')->constrained('mod_shops'); // Annahme: ModShops ist der Tabellenname der Shops
            $table->decimal('distance_km', 8, 2);
            $table->decimal('delivery_cost', 8, 2);
            $table->decimal('free_delivery_threshold', 8, 2);
            $table->decimal('latitude', 8, 5)->nullable();
            $table->decimal('longitude', 8, 5)->nullable();
            $table->decimal('radius', 10, 2)->nullable();
            $table->string('color')->nullable();
            // Weitere Spalten je nach Bedarf
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_areas');
    }
};
