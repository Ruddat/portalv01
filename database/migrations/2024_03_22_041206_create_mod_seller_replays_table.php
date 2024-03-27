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
        Schema::create('mod_seller_replays', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('voting_id');
            $table->text('reply_author');
            $table->text('reply_title');
            $table->text('reply_content');
            $table->timestamps();

            $table->foreign('voting_id')->references('id')->on('mod_seller_votings')->onDelete('cascade');
            // 'onDelete('cascade')' sorgt dafür, dass die Replays gelöscht werden, wenn der zugehörige Voting-Eintrag gelöscht wird
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mod_seller_replays');
    }
};
