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
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->string('title')->required();
            $table->string('slug')->required();
            $table->text('description')->required();
            $table->string('location')->required();
            $table->timestamp('start_date')->required();
            $table->timestamp('end_date')->required();
            $table->string('thumbnail')->required(); // path ke gambar
            $table->text('excerpt')->required(); // deskripsi singkat
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->integer('price')->required();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainings');
    }
};
