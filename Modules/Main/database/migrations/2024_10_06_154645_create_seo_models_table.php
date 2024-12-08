<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('seo_models', function (Blueprint $table) {
            $table->id();
            $table->morphs('model');

            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->text('keywords')->nullable();
            $table->string('conical_url')->nullable();

            $table->enum('indexable',['index','noindex'])->default('index');
            $table->enum('followable',['follow','nofollow'])->default('follow');

            $table->string('seo_type')->default('WebPage');
            $table->text('schema')->nullable();
            $table->text('sitemap')->nullable();

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('seo_models');
    }
};
