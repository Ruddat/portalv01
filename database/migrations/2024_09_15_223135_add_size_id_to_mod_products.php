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
            $table->unsignedBigInteger('size_id')->nullable()->after('category_id');

            // Optional: Set foreign key relationship
            $table->foreign('size_id')->references('id')->on('mod_product_sizes')->onDelete('set null');
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
