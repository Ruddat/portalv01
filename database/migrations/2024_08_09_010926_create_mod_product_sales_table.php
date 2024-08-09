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
        // Erweiterung der ModProducts-Tabelle
        Schema::table('mod_products', function (Blueprint $table) {
            $table->integer('sales_count')->default(0)->after('base_price'); // sales_count hinzufügen
        });

        // Erstellung der ProductSales-Tabelle
        Schema::create('mod_product_sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('shop_id'); // Shop-ID hinzufügen
            $table->integer('quantity');
            $table->date('sale_date');
            $table->timestamps();

            // Fremdschlüssel-Beziehung zu ModProducts
            $table->foreign('product_id')->references('id')->on('mod_products')->onDelete('cascade');
            $table->foreign('shop_id')->references('id')->on('mod_shops')->onDelete('cascade'); // Annahme: Shops-Tabelle existiert

            // Indizes hinzufügen
            $table->index('product_id');
            $table->index('shop_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mod_product_sales');


        // Entfernen der sales_count-Spalte aus der ModProducts-Tabelle
        Schema::table('mod_products', function (Blueprint $table) {
             $table->dropColumn('sales_count');
             });

    }
};
