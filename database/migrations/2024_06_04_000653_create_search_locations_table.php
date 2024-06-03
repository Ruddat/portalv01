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
        Schema::create('mod_search_locations', function (Blueprint $table) {
            $table->id();
            $table->integer('place_id');
            $table->string('licence');
            $table->string('osm_type');
            $table->integer('osm_id');
            $table->string('lat');
            $table->string('lon');
            $table->string('class');
            $table->string('type');
            $table->integer('place_rank');
            $table->decimal('importance', 16, 15);
            $table->string('addresstype');
            $table->string('name');
            $table->string('display_name');
            $table->json('address');
            $table->json('boundingbox');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mod_search_locations');
    }
};
