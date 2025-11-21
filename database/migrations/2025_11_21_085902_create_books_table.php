<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();

            $table->string('title');                      // Judul buku
            $table->string('image')->nullable();         // Path gambar
            $table->text('description')->nullable();     // Deskripsi singkat
            $table->decimal('price', 12, 2);             // Harga buku
            $table->integer('stock');                    // Stok
            $table->boolean('is_bestseller')->default(false);
            $table->unsignedInteger('bestseller_order')->nullable();

            // Relasi kategori
            $table->foreignId('category_id')
                  ->constrained('categories')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
