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
            $table->string('address');
            $table->string('lat');
            $table->string('lng');
            $table->string('phone');
            $table->string('email');
            $table->string('categories');
            $table->double('charge')->default(0);
            $table->double('markup')->default(0);
            $table->double('per_order')->default(0);
            $table->double('price_sms')->default(0);
            $table->double('broker')->default(0);
            $table->double('registration_price')->default(0);
            $table->string('order_email');
            $table->string('order_fax');
            $table->string('order_sms');
            $table->string('order_account_nr');
            $table->string('blz');
            $table->string('bank');
            $table->string('owner');
            $table->text('extra_contacts');
            $table->string('note');
            $table->string('accessories');
            $table->string('password');
            $table->tinyInteger('transfer')->default(0);
            $table->string('soap_username');
            $table->string('soap_password');
            $table->tinyInteger('feedbacks')->default(0);
            $table->tinyInteger('justdeliverlogo')->default(0);
            $table->string('domain');
            $table->string('backlink');
            $table->tinyInteger('cash_active')->default(0);
            $table->tinyInteger('ec_card_active')->default(0);
            $table->double('ec_card_price')->default(0);
            $table->tinyInteger('cab_active')->default(0);
            $table->string('cab_transaction_url');
            $table->string('cab_key');
            $table->string('cab_seller_id');
            $table->string('cab_password');
            $table->tinyInteger('ueberweisung_active')->default(0);
            $table->tinyInteger('ueberweisung_use_system')->default(0);
            $table->string('ueberweisung_pass');
            $table->string('ueberweisung_proj');
            $table->string('ueberweisung_user');
            $table->tinyInteger('paypal_active')->default(0);
            $table->tinyInteger('paypal_use_system')->default(0);
            $table->string('paypal_api_username')->nullable();
            $table->string('paypal_api_password')->nullable();
            $table->string('paypal_api_signature')->nullable();
            $table->string('paypal_api_endpoint')->nullable();
            $table->string('paypal_url')->nullable();
            $table->string('logo');
            $table->char('lang', 2)->default('lt');
            $table->integer('ordering');
            $table->integer('ordering2')->default(0);
            $table->tinyInteger('published')->default(1);
            $table->enum('status', ['on', 'off', 'closed', 'limited'])->default('off');
            $table->dateTime('activation_date');
            $table->dateTime('date');
            $table->text('contact_info');
            $table->tinyInteger('send_invoice_by')->default(0);
            $table->integer('free_orders');
            $table->date('free_timeline');
            $table->double('per_turnover');
            $table->text('invoice_payment_account');
            $table->integer('payment_usage_amount')->default(0);
            $table->tinyInteger('no_selbstabholung')->default(0);
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
            $table->text('jobs');
            $table->tinyInteger('show_jobs_menu')->default(0);
            $table->dateTime('show_jobs_menu_until');
            $table->string('jobs_email');
            $table->tinyInteger('show_allergenic_menu')->default(0);
            $table->integer('design_id')->default(0);
            $table->integer('eshop_discount')->default(0);
            $table->dateTime('eshop_discount_valid');
            $table->string('winorder_version')->default('4');
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
