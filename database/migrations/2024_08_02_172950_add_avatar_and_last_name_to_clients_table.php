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
        Schema::table('clients', function (Blueprint $table) {
            //
            $table->string('avatar')->nullable()->after('email');
            $table->string('last_name')->nullable()->after('name');
            $table->string('remember_token')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            //
            $table->dropColumn('avatar');
            $table->dropColumn('last_name');
            $table->dropColumn('remember_token');
        });
    }
};
