<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('shop_attribute_product', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained('shop_products')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('attribute_id')->constrained('shop_attributes')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('value_id')->constrained('shop_attribute_values')->cascadeOnDelete()->cascadeOnUpdate();

            $table->unique(['product_id', 'attribute_id', 'value_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shop_attribute_products');
    }
};
