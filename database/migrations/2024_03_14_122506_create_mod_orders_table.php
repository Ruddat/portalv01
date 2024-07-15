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
        Schema::create('mod_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('order_nr')->nullable();
          // $table->integer('parent')->default(0)->comment('shop id');
           // $table->integer('parent')->default(0)->constrained('mod_shops')->comment('ID des Shops, dem diese Bestellung zugeordnet ist');
            $table->foreignId('parent')->constrained('mod_shops')->comment('shop_id');
            $table->string('shop_name')->nullable();
            $table->string('hash')->unique()->comment('unique value for every order');
            $table->integer('gender');
            $table->string('name');
            $table->string('surname');
            $table->string('company')->nullable();
            $table->string('department')->nullable();
            $table->string('email');
            $table->string('phone_prefix', 10)->nullable();
            $table->string('phone');
            $table->string('clients_ip')->nullable();
            $table->integer('shipping_zip_id')->default(0);
            $table->string('shipping_street');
            $table->string('shipping_house_no');
            $table->string('shipping_zip', 10);
            $table->string('shipping_city');
            $table->string('shipping_state')->nullable()->comment('reserved for future purposes');
            $table->string('shipping_country_code', 3)->default('DE');
            $table->string('shipping_lat')->default(0);
            $table->string('shipping_lng')->default(0);
            $table->string('shipping_comment')->nullable();
            $table->string('delivery_time')->nullable();
            $table->string('shipping_type', 50)->comment('[pickup, delivery]');
            $table->string('order_comment')->nullable();
            $table->string('payment_type', 50)->comment('[cab, cash, ec-card, paypal, ueberweisung, ..]');
            // ----------------------------------------------------------------
            $table->decimal('price_products', 10, 2);
            $table->integer('price_bottles')->default(0);
            $table->decimal('price_shipping', 10, 2);
            $table->decimal('price_payment', 10, 2);
            $table->decimal('price_tips', 10, 2);
            $table->decimal('coupon_discount', 10, 2)->default(0);
            $table->decimal('eshop_discount', 10, 2);
            $table->decimal('price_total', 10, 2);
            $table->tinyInteger('use_system_payment')->default(0);
            $table->integer('soap_status')->default(0);
            $table->tinyInteger('transfer_type')->nullable()->comment('1 - fax, 2 - email, 3 - soap, 4 - sms, 5 - reserved');
           // $table->integer('pizzamanager_id')->default(0);
            $table->tinyInteger('transfer_by_email')->default(1);
            $table->dateTime('transfer_time')->nullable();
            $table->tinyInteger('subscribe_news')->default(0);
            $table->tinyInteger('save_data')->default(0);
            $table->tinyInteger('published')->default(1);
            $table->tinyInteger('money_returned')->default(0);
            $table->integer('user_id')->default(0)->constrained('seller')->comment('Seller ID dem die Bestellung zugeordnet ist');
            $table->tinyInteger('stickers_delivery_checked')->default(0);
            $table->text('cart_in_session');
            $table->integer('delivery_time_left')->default(0);
            $table->integer('global_coupon_id')->default(0);
            $table->string('coupon_code');
            $table->string('rand_id', 20);
            $table->integer('user_status')->default(0)->comment('400 - error, 500 - canceled');
          // wegen rest api call
            $table->timestamp('order_date')->nullable();
            $table->string('order_tracking_status')->default(0)->comment('999999 - new (created), 1 - ready to send, 2 - restaurant received, 3 - baking, 4 - delivering, 5 - boxing (packing), 6 - delivered (done), 400 - error, 500 - canceled');
            $table->string('deliver_eta')->nullable();
            $table->string('message')->nullable();
            $table->integer('deliver_minutes')->nullable();
            $table->string('reject_reason')->nullable();
            $table->json('order_json_data')->nullable();

            $table->timestamps();
        });
                // Indexes
                Schema::table('mod_orders', function (Blueprint $table) {
                    $table->index('id');
                    $table->index('hash');
                    $table->index('shipping_zip');
                });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mod_orders');
    }
};
