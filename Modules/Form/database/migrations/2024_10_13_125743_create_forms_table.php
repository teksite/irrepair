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
        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->text('body')->nullable();
            $table->text('rules')->nullable();
            $table->text('emails')->nullable();
            $table->text('phones')->nullable();
            $table->string('telegram_id')->nullable();
            $table->text('urls')->nullable();
            $table->string('template')->nullable();
            $table->boolean('recaptcha')->default(true);
            $table->boolean('has_file')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forms');
    }
};
