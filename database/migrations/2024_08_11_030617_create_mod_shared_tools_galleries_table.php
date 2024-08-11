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
        Schema::create('mod_shared_tools_galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('image_path');
            $table->string('thumbnail_path')->nullable();
            $table->string('category_image_path')->nullable();
            $table->foreignId('subcategory_id')->nullable()->constrained('mod_shared_tools_gallery_categories')->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained('mod_shared_tools_gallery_categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mod_shared_tools_galleries');
    }
};
