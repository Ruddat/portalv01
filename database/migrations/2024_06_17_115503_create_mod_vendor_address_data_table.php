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
        Schema::create('mod_vendor_address_data', function (Blueprint $table) {
            $table->id();
            $table->string('street');
            $table->string('housenumber');
            $table->string('postal_code');
            $table->string('city');
            $table->string('city_district')->nullable();
            $table->string('suburb')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mod_vendor_address_data');
    }
};
