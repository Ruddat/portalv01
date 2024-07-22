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
        Schema::create('mod_sys_csv_exports', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->text('file_content'); // Hier speichern wir den Inhalt der CSV-Datei
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('csv_exports');
    }
};
