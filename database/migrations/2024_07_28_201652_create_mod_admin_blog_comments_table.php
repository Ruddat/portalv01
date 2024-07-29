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
        Schema::create('mod_admin_blog_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained('mod_admin_blog_posts')->onDelete('cascade');
            $table->string('author');
            $table->string('email');
            $table->text('content');
            $table->boolean('approved')->default(false);
            $table->boolean('moderate')->default(true);
            $table->string('verification_token')->nullable();
            $table->string('avatar')->nullable();
            $table->string('avatar_reply')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('mod_admin_blog_comments')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mod_admin_blog_comments');
    }
};
