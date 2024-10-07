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
        Schema::create('marketing_campaign_participants', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->unsignedBigInteger('marketing_setting_id');
            $table->unsignedBigInteger('shop_id');
            $table->string('voucher_code');
            $table->boolean('used')->default(false); // Track if the voucher has been used
            $table->date('valid_until'); // Voucher validity date
            $table->decimal('discount_percentage', 5, 2); // Store discount percentage for each participant
            $table->timestamps();

            $table->foreign('marketing_setting_id')->references('id')->on('mod_admin_marketing_settings')->onDelete('cascade');
            $table->foreign('shop_id')->references('id')->on('mod_shops')->onDelete('cascade');
            $table->unique(['email', 'marketing_setting_id'], 'unique_email_setting');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marketing_campaign_participants');
    }
};
