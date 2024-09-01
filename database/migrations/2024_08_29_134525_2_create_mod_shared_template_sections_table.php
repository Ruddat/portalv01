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
        Schema::create('mod_shared_template_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('template_id')->constrained('mod_shared_templates')->onDelete('cascade');
            $table->string('name');
            $table->text('content')->nullable();
            $table->string('type')->default('section');
            $table->boolean('editable')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mod_shared_template_sections');
    }
};
