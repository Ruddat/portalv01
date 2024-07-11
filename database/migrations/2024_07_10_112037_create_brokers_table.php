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
        Schema::create('brokers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('phone')->nullable();
            // -------------------------------
            $table->string('username')->unique()->nullable();
            $table->string('password')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('status',['Pending','inReview','Active'])->default('Pending');

            // -------------------------------
            $table->string('location_to_work')->nullable();
            $table->string('your_age')->nullable();
            $table->string('how_hear')->nullable();
            $table->string('vehicle')->nullable();
            $table->string('terms')->nullable();
            // -------------------------------

            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('country')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_type')->nullable();
            $table->string('company_register_number')->nullable();
            $table->string('company_register_city')->nullable();
            $table->string('company_register_country')->nullable();
            $table->string('company_register_address')->nullable();
            $table->string('company_register_zip_code')->nullable();
            $table->string('company_register_phone')->nullable();
            $table->string('company_register_email')->nullable();
            $table->string('company_register_website')->nullable();
            $table->string('company_register_tax_number')->nullable();
            $table->string('company_register_vat_id')->nullable(); // Umsatzsteuer-ID, falls vorhanden
            $table->string('company_register_vehicle_type')->nullable();
            $table->decimal('company_register_commission_rate', 5, 2)->nullable(); // Percentage value like 30.00 for 30%
            $table->string('tax_office')->nullable();
            $table->string('tax_office_address')->nullable();
            $table->string('tax_office_zip_code')->nullable();
            $table->string('tax_office_city')->nullable();
            $table->string('tax_office_country')->nullable();
            $table->string('tax_office_phone')->nullable();
            $table->string('tax_office_email')->nullable();
            $table->string('tax_office_website')->nullable();
            $table->string('tax_office_tax_number')->nullable();
            $table->string('tax_office_vat_id')->nullable(); // Umsatzsteuer-ID, falls vorhanden
            $table->string('tax_office_vehicle_type')->nullable();
            $table->decimal('tax_office_commission_rate', 5, 2)->nullable(); // Percentage value like 30.00 for 30%
            $table->string('tax_number')->nullable();
            $table->string('vat_id')->nullable(); // Umsatzsteuer-ID, falls vorhanden
            $table->string('vehicle_type')->nullable();
            $table->decimal('commission_rate', 5, 2)->nullable(); // Percentage value like 30.00 for 30%
            $table->json('documents')->nullable(); // JSON field for various documents
            $table->json('payment_settings')->nullable(); // JSON field for payment settings
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brokers');
    }
};
