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
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable()->default(0);
            $table->string('title');
            $table->text('body')->nullable();
            $table->string('slug')->unique();
            $table->string('featured_image')->nullable();
            $table->timestamps();
        });

        Schema::create('blog_category_post', function (Blueprint $table) {
            $table->foreignId('category_id')->constrained('blog_categories')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('post_id')->constrained('blog_posts')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unique(['category_id','post_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_category_post');
        Schema::dropIfExists('blog_categories');
    }
};
