<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('mod_sys_invoices', function (Blueprint $table) {
            $table->string('pdf_path')->nullable()->after('payment_json_data');
            $table->string('payment_status')->nullable()->after('payment_json_data');
        });
    }

    public function down()
    {
        Schema::table('mod_sys_invoices', function (Blueprint $table) {
            $table->dropColumn('pdf_path');
            $table->dropColumn('payment_status');
        });
    }
};
