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
            $table->decimal('paypal_express_fee_fixed', 10, 2)
                ->nullable()
                ->comment('Paypal Express Festgebühr');
            $table->decimal('paypal_express_fee_percentage', 5, 2)
                ->nullable()
                ->comment('Paypal Express Transaktionsgebühr in Prozent');
            $table->decimal('emergency_sms_cost', 10, 2)
                ->nullable()
                ->comment('Kosten für Notfall-SMS');
            $table->decimal('service_fee_non_paypal', 10, 2)
                ->nullable()
                ->comment('Servicepauschale für Onlinezahlungen ohne Paypal');
            $table->decimal('instant_payout_fee_percentage', 5, 2)
                ->nullable()
                ->comment('Sofortauszahlungen Prozent');
            $table->decimal('sales_commission', 5, 2)
                ->nullable()
                ->comment('Umsatzprovision');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('general_settings', function (Blueprint $table) {
            $table->dropColumn([
                'paypal_express_fee_fixed',
                'paypal_express_fee_percentage',
                'emergency_sms_cost',
                'service_fee_non_paypal',
                'instant_payout_fee_percentage',
                'sales_commission'
            ]);
        });
    }
};
