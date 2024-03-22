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
            $table->unsignedBigInteger('voting_id');
            $table->enum('type', ['up', 'down']); // Daumen-hoch oder Daumen-runter
            $table->timestamps();

            $table->foreign('voting_id')->references('id')->on('votings')->onDelete('cascade');
            // 'onDelete('cascade')' sorgt dafür, dass die Abstimmungen gelöscht werden, wenn der zugehörige Voting-Eintrag gelöscht wird
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
