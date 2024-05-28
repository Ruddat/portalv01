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
        Schema::create('sys_request_logs', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address');
            $table->string('url');
            $table->string('method');
            $table->string('user_agent');
            $table->timestamp('timestamp');
            $table->unsignedInteger('count')->default(1); // Neue Spalte für die Zählung
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sys_request_logs');
    }
};
