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
        Schema::create('mod_shared_user_templates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('sellers');
            $table->foreignId('shop_id')->constrained('mod_shops'); // Verknüpfung mit Shop
            $table->foreignId('template_id')->constrained('mod_shared_templates');
            $table->json('selected_sections')->nullable(); // Speichert die ausgewählten Sektionen
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mod_shared_user_templates');
    }
};
