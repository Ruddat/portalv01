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
        Schema::create('mod_order_status_histories', function (Blueprint $table) {
            $table->id(); // Auto-Increment ID
            $table->unsignedBigInteger('order_id'); // Verknüpfung zur mod_orders Tabelle
            $table->integer('status'); // Der Bestellstatus
            $table->timestamp('changed_at')->useCurrent(); // Zeitpunkt der Statusänderung
            $table->foreign('order_id')->references('id')->on('mod_orders')->onDelete('cascade'); // Fremdschlüssel-Verknüpfung zur mod_orders Tabelle
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mod_order_status_histories');
    }
};
