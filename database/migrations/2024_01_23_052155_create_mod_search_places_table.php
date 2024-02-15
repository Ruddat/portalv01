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
        Schema::create('mod_search_places', function (Blueprint $table) {
            $table->id();
            $table->string('place_id')->nullable();
            $table->string('licence')->nullable();
            $table->string('osm_type')->nullable();
            $table->string('osm_id')->nullable();
            $table->string('lat')->nullable();
            $table->string('lon')->nullable();
            $table->string('class')->nullable();
            $table->string('type')->nullable();
            $table->integer('place_rank')->nullable();
            $table->double('importance')->nullable();
            $table->string('addresstype')->nullable();
            $table->string('name')->nullable();
            $table->text('display_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mod_search_places');
    }
};
