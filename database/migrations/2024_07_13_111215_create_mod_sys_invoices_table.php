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
        Schema::create('mod_sys_invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shop_id');
            $table->decimal('total_amount', 10, 2);
            $table->decimal('cash_amount', 10, 2);
            $table->decimal('ec_card_amount', 10, 2);
            $table->decimal('paypal_amount', 10, 2);
            $table->decimal('other_amounts', 10, 2);
            $table->integer('total_orders');
            $table->decimal('average_order_value', 10, 2);
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamp('generated_at');
            $table->json('order_json_data')->nullable();
            $table->json('invoice_json_data')->nullable();
            $table->json('payment_json_data')->nullable();
            $table->integer('invoice_number')->unique(); // Adding the invoice number column

            $table->timestamps();

            // Foreign key constraint
            $table->foreign('shop_id')->references('id')->on('mod_shops')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mod_sys_invoices');
    }
};
