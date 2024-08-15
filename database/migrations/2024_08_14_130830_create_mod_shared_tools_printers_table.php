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
        Schema::create('mod_shared_tools_printers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('port')->nullable(); // Nur für Netzwerkdrucker
            $table->string('driver')->nullable(); // Optional, für Treiberinformationen
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mod_shared_tools_printers');
    }
};
