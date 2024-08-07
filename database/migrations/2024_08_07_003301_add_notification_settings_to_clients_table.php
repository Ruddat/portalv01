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
            $table->boolean('email_notifications')->default(true);
            $table->boolean('push_notifications')->default(true);
            $table->boolean('auto_group_subscribe')->default(true);
            $table->boolean('auto_product_subscribe')->default(false);
            $table->boolean('account_changes')->default(true);
            $table->boolean('group_changes')->default(true);
            $table->boolean('product_updates')->default(true);
            $table->boolean('new_products')->default(true);
            $table->boolean('promotional_offers')->default(false);
            $table->boolean('comment_notifications')->default(true);
            $table->boolean('share_notifications')->default(false);
            $table->boolean('follow_notifications')->default(true);
            $table->boolean('group_post_notifications')->default(false);
            $table->boolean('private_message_notifications')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            //
        });
    }
};
