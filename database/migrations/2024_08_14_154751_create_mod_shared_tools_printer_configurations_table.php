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
        Schema::create('mod_shared_tools_printer_configurations', function (Blueprint $table) {
            $table->id();
            // Die Fremdschlüsselbeziehung zu 'mod_shops' korrekt konfigurieren
            $table->foreignId('shop_id')->constrained('mod_shops')->onDelete('cascade');
            // Die Fremdschlüsselbeziehung zu 'printers' korrekt konfigurieren
            $table->foreignId('printer_id')->constrained('mod_shared_tools_printers')->onDelete('cascade');
            $table->string('computer_name'); // Name oder Identifikation des Rechners
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mod_shared_tools_printer_configurations');
    }
};
