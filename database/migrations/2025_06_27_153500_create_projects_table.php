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
        Schema::create('projects', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('image_url');
        $table->string('source_code_url')->nullable();
        $table->string('live_demo_url')->nullable();
        $table->enum('category', ['Website', 'Application', 'Visual']);
        $table->text('tech_stack_description'); // Untuk menyimpan tag HTML tech stack
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
