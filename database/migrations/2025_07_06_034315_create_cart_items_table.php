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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('variant_id')->constrained('product_variants')->onDelete('cascade');
            $table->foreignId('size_id')->nullable()->constrained('product_sizes')->onDelete('set null');

            $table->unsignedInteger('quantity')->default(1); // jumlah unit
            $table->decimal('requested_meter', 5, 2)->default(1); // meter per unit

            $table->string('custom_size_hash', 64)->nullable(); // hash dari custom_size_note
            $table->text('custom_size_note')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();

            // Pastikan item unik berdasarkan kombinasi ini
            $table->unique(['cart_id', 'variant_id', 'size_id', 'custom_size_hash'], 'unique_cart_items');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
