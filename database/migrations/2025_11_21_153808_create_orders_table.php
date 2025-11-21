<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('fullname');
            $table->string('address', 500);
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('phone');
            $table->string('email')->nullable();

            $table->string('shipping_method')->nullable();  // jne, sicepat, dst
            $table->string('payment_method')->nullable();   // bank, wallet, etc

            $table->unsignedBigInteger('subtotal'); // total harga barang (tanpa ongkir)
            $table->unsignedBigInteger('shipping_cost')->default(0);
            $table->unsignedBigInteger('total');    // subtotal + shipping

            $table->string('status')->default('pending'); // pending, paid, shipped, completed, cancelled

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
