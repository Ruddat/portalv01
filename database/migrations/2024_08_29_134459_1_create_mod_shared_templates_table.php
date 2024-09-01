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
        Schema::create('mod_shared_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('preview_image')->nullable(); // Vorschau-Bild des Templates
            $table->text('html_skeleton')->nullable(); // Grundgerüst des Templates (HTML-Struktur)
            $table->string('file_path')->nullable(); // Pfad zur Datei, falls das Template aus einer Datei geladen wird
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mod_shared_templates');
    }
};
