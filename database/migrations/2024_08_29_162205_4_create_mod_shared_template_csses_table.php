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
        Schema::create('mod_shared_template_csses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('template_id')->constrained('mod_shared_templates')->onDelete('cascade');
            $table->text('css_content')->nullable(); // Hier wird der CSS-Code gespeichert
            $table->string('file_path')->nullable(); // Pfad zur Datei hinzufügen

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mod_shared_template_csses');
    }
};
