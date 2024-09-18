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
        Schema::create('temp_parent_mapping', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('old_parent_id');
            $table->unsignedBigInteger('new_parent_id');
            $table->timestamps();

            // Optional: Add unique constraint to ensure old_parent_id is unique
            $table->unique('old_parent_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temp_parent_mapping');
    }
};
