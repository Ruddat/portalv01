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
        Schema::table('general_settings', function (Blueprint $table) {
            $table->string('company_name')->default('Just Deliver UGFoodieBlitz');
            $table->string('address')->default('Rebenring 18');
            $table->string('postal_code', 20)->default('38118');
            $table->string('city')->default('Braunschweig');
            $table->string('country')->default('Deutschland');
            $table->string('ceo_name')->default('Ingo Ruddat');
            $table->string('phone')->default('+49');
            $table->string('bank_name')->default('Commerzbank');
            $table->string('iban')->default('xxxxxxxxxx');
            $table->string('register_court')->default('Amtsgericht Braunschweig');
            $table->string('hrb')->default('HRB');
            $table->string('vat_number')->default('USt.-Nr. DE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('general_settings', function (Blueprint $table) {
            $table->dropColumn([
                'company_name',
                'address',
                'postal_code',
                'city',
                'country',
                'ceo_name',
                'phone',
                'bank_name',
                'iban',
                'register_court',
                'hrb',
                'vat_number'
            ]);
        });
    }
};
