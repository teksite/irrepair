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
        Schema::create('shop_order_payments', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_code')->nullable();
            $table->foreignId('order_id')->constrained('shop_orders')->onDelete('cascade');
            $table->string('res_number');
            $table->bigInteger('price');
            $table->boolean('status')->default(0);
            $table->timestamps();
            $table->ipAddress();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_order_payments');
    }
};
