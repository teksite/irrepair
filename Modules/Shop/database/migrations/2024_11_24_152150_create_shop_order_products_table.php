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
        Schema::create('shop_order_products', function (Blueprint $table) {
            $table->foreignId('order_id')->constrained('shop_orders')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('product_id')->nullable()->constrained('shop_products')->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('quantity')->nullable();
            $table->string('price')->nullable();
            $table->string('type')->nullable();
            $table->string('title')->nullable();
            $table->primary(['order_id','product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_order_products');
    }
};
