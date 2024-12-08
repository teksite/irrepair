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
        Schema::create('shop_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained('shop_categories')->cascadeOnUpdate()->nullOnDelete();
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->text('introduction')->nullable();
            $table->text('body')->nullable();
            $table->text('chapters')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->text('faq')->nullable();
            $table->string('order')->default(1);
            $table->text('price_offline_regular')->nullable();
            $table->text('price_offline_sell')->nullable();
            $table->text('price_online_regular')->nullable();
            $table->text('price_online_sell')->nullable();
            $table->text('price_instalment_regular')->nullable();
            $table->text('price_instalment_sell')->nullable();
            $table->string('template')->nullable();

            $table->string('status')->default('published');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_products');
    }
};
