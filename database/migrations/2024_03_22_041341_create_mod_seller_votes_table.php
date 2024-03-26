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
        Schema::create('mod_seller_votes', function (Blueprint $table) {
            $table->id();
            // Shop ID hinzufügen
            $table->unsignedBigInteger('shop_id');
            $table->unsignedBigInteger('voting_id');
            $table->enum('type', ['like', 'dislike']); // Daumen-hoch oder Daumen-runter
            $table->unsignedInteger('likes_count')->default(0); // Spalte für die Anzahl der Likes
            $table->unsignedInteger('dislikes_count')->default(0); // Spalte für die Anzahl der Dislikes
            // Order Hash hinzufügen
            $table->string('order_hash');
            $table->timestamps();

            $table->foreign('voting_id')->references('id')->on('mod_seller_votings')->onDelete('cascade');
            // 'onDelete('cascade')' sorgt dafür, dass die Abstimmungen gelöscht werden, wenn der zugehörige Voting-Eintrag gelöscht wird
            // Fremdschlüsselbeziehung zu mod_shops
            $table->foreign('shop_id')->references('id')->on('mod_shops')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mod_seller_votes');
    }
};
