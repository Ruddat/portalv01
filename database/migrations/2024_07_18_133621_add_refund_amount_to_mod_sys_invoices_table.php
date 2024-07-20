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
            //
            $table->decimal('refund_amount', 8, 2)->default(0);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mod_sys_invoices', function (Blueprint $table) {
            //
            $table->dropColumn('refund_amount');

        });
    }
};
