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
        Schema::create('mod_admin_marketing_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('duration'); // Dauer in Tagen
            $table->decimal('discount_percentage', 5, 2); // Rabatt in Prozent
            $table->integer('validity_days')->default(30); // Gültigkeit des Gutscheins in Tagen
            $table->integer('usage_limit')->default(1); // Wie oft der Gutschein verwendet werden kann
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mod_admin_marketing_settings');
    }
};
