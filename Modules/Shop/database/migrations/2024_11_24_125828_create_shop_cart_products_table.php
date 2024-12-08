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
        Schema::create('shop_cart_products', function (Blueprint $table) {
            $table->foreignId('cart_id')->constrained('shop_carts')->cascadeOnUpdate()->cascadeOnUpdate();
            $table->foreignId('product_id')->constrained('shop_products')->cascadeOnUpdate()->cascadeOnUpdate();
            $table->string('type')->nullable();
            $table->string('quantity')->nullable();
            $table->unique(['cart_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_cart_products');
    }
};
