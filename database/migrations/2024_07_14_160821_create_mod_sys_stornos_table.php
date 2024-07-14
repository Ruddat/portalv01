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
        Schema::create('mod_sys_stornos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->decimal('refund_amount', 10, 2);
            $table->string('refund_reason');
            $table->boolean('included_in_invoice')->default(false);
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('order_id')->references('id')->on('mod_orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mod_sys_stornos');
    }
};
