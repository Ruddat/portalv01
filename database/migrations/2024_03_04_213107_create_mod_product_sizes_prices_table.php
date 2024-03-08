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
        Schema::create('mod_product_sizes_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent')->constrained('mod_products')->comment('ID des Produkts, dem dieser Preis zugeordnet ist');
            $table->integer('size_id')->nullable()->comment('ID der Größe des Produkts');
            $table->foreignId('shop_id')->constrained('mod_shops')->comment('ID des Shops, dem dieses Produkt zugeordnet ist');
            $table->decimal('price', 8, 2)->default(0)->comment('Preis des Produkts in der angegebenen Größe');
            $table->boolean('visibility')->default(true)->comment('Gibt an, ob der Preis sichtbar ist oder nicht');
            $table->integer('action_id')->default(0)->comment('ID einer Aktion (falls vorhanden) für den Preis');
            $table->double('action_price')->default(0)->comment('Preis für die Aktion');
            $table->integer('ordering')->default(10000)->comment('Reihenfolge, in der die Preise angezeigt werden sollen');
            $table->timestamps(); // Zeitstempel für Erstellung und Aktualisierung
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mod_product_sizes_prices');
    }
};
