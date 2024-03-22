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
        Schema::create('mod_shops', function (Blueprint $table) {
            $table->id();
            $table->integer('parent')->default(0);
            $table->string('shop_nr');
            $table->string('title');
            $table->string('street');
            $table->string('zip');
            $table->string('city');
            $table->string('lat')->default(0);
            $table->string('lng')->default(0);
            $table->string('phone');
            $table->string('email');
            $table->string('categories')->default(0);
            $table->double('charge')->default(0);
            $table->double('markup')->default(0);
            $table->double('per_order')->default(0);
            $table->double('price_sms')->default(0);
            $table->string('broker')->nullable();
            $table->double('registration_price')->default(0);
            $table->string('order_email')->default(0);
            $table->string('order_fax')->default(0);
            $table->string('order_sms')->default(0);
            $table->string('order_account_nr')->default(0);
            $table->string('blz')->default(0);
            $table->string('bank')->default(0);
            $table->string('owner')->default(0);
            $table->text('extra_contacts')->nullable();
            $table->string('note')->default(0);
            $table->string('accessories')->default(0);
            $table->string('password')->default(0);
            $table->tinyInteger('transfer')->default(0);
            $table->string('soap_username')->default(0);
            $table->string('soap_password')->default(0);
            $table->string('api_username')->default(0);
            $table->string('api_password')->default(0);
            $table->tinyInteger('feedbacks')->default(0);
            $table->tinyInteger('justdeliverlogo')->default(0);
            $table->string('domain')->default(0);
            $table->string('backlink')->default(0);
            $table->tinyInteger('cash_active')->default(0);
            $table->tinyInteger('ec_card_active')->default(0);
            $table->double('ec_card_price')->default(0);
            $table->tinyInteger('cab_active')->default(0);
            $table->tinyInteger('paypal_active')->default(0);
            $table->tinyInteger('paypal_use_system')->default(0);
            $table->string('paypal_api_username')->nullable();
            $table->string('paypal_api_password')->nullable();
            $table->string('paypal_api_signature')->nullable();
            $table->string('paypal_api_endpoint')->nullable();
            $table->string('paypal_url')->nullable();
            $table->string('logo')->nullable();
            $table->char('lang', 2)->default('de');
            $table->integer('ordering')->default(0);
            $table->integer('ordering2')->default(0);
            $table->tinyInteger('published')->default(1);
            $table->enum('status', ['on', 'off', 'closed', 'limited'])->default('off');
            $table->dateTime('activation_date')->nullable();
            $table->dateTime('date')->nullable();
            $table->text('contact_info')->nullable();
            $table->tinyInteger('send_invoice_by')->default(0);
            $table->integer('free_orders')->default(0);
            $table->date('free_timeline')->nullable();
            $table->double('per_turnover')->default(0);
            $table->text('invoice_payment_account')->nullable();
            $table->integer('payment_usage_amount')->default(0);
            $table->tinyInteger('no_abholung')->default(0);
            $table->tinyInteger('no_lieferung')->default(0);
            $table->double('rating')->default(0);
            $table->integer('paid_on_top')->default(0);
            $table->tinyInteger('show_logo')->default(1);
            $table->tinyInteger('have_new_products')->default(0);
            $table->tinyInteger('actiontime_exist')->default(0);
            $table->tinyInteger('stickers_exist')->default(0);
            $table->string('fax_activation_error_code')->nullable();
            $table->string('fax_activation_jobID')->nullable();
            $table->integer('fax_activation_status')->nullable();
            $table->timestamp('fax_activation_started_time')->useCurrent()->nullable();
            $table->double('stickers_from')->default(0);
            $table->tinyInteger('auto_payment')->default(0);
            $table->tinyInteger('new_products_layout')->default(0);
            $table->text('jobs')->nullable();
            $table->tinyInteger('show_jobs_menu')->default(0);
            $table->dateTime('show_jobs_menu_until')->nullable();
            $table->string('jobs_email')->default(0);
            $table->tinyInteger('show_allergenic_menu')->default(0);
            $table->integer('design_id')->default(0);
            $table->integer('eshop_discount')->default(0);
            $table->dateTime('eshop_discount_valid')->nullable();
            $table->string('winorder_version')->default('4');
            $table->string('progress')->default('0');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mod_shops');
    }
};
