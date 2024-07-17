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
        Schema::table('mod_sys_invoices', function (Blueprint $table) {
            $table->integer('cash_count')->nullable()->after('cash_amount');
            $table->integer('ec_card_count')->nullable()->after('ec_card_amount');
            $table->integer('paypal_count')->nullable()->after('paypal_amount');
            $table->integer('other_count')->nullable()->after('other_amounts');
            $table->decimal('paypal_fee', 10, 2)->nullable()->after('paypal_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mod_sys_invoices', function (Blueprint $table) {
            $table->dropColumn('paypal_fee');
            $table->dropColumn('other_count');
            $table->dropColumn('paypal_count');
            $table->dropColumn('ec_card_count');
            $table->dropColumn('cash_count');
        });
    }
};

