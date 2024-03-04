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
        Schema::table('mod_products', function (Blueprint $table) {
            // Überprüfe, ob die Spalte category_id bereits vorhanden ist, bevor sie hinzugefügt wird
            if (!Schema::hasColumn('mod_products', 'category_id')) {
                $table->unsignedBigInteger('category_id');
                $table->foreign('category_id')->references('id')->on('mod_categories');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mod_products', function (Blueprint $table) {
            //
        });
    }
};
