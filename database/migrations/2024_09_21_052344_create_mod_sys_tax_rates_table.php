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
        Schema::create('mod_sys_tax_rates', function (Blueprint $table) {
            $table->id();
            $table->string('country_code', 2)->index(); // Ländercode mit Index
            $table->decimal('standard_rate', 5, 2)->nullable(); // Standard MwSt.-Satz
            $table->decimal('reduced_rate', 5, 2)->nullable(); // Ermäßigter Satz
            $table->enum('category', ['Food', 'Drinks', 'Non-Food']); // Kategorie (Essen, Getränke, Non-Food)
            $table->timestamps();

            // Unique Constraint für country_code und category
            $table->unique(['country_code', 'category']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mod_sys_tax_rates');
    }
};
