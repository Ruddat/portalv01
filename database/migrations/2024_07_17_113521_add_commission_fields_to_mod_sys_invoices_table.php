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
            $table->decimal('commission', 10, 2)->nullable()->after('other_count');
            $table->decimal('commission_amount', 10, 2)->nullable()->after('commission');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mod_sys_invoices', function (Blueprint $table) {
            //
            $table->dropColumn('commission');
            $table->dropColumn('commission_amount');
        });
    }
};
