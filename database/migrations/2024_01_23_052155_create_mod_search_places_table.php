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
            $table->string('place_id');
            $table->string('licence');
            $table->string('osm_type');
            $table->string('osm_id');
            $table->string('lat');
            $table->string('lon');
            $table->string('class');
            $table->string('type');
            $table->integer('place_rank');
            $table->double('importance');
            $table->string('addresstype');
            $table->string('name');
            $table->text('display_name');
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
