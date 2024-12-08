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
        Schema::create('announcement_user', function (Blueprint $table) {
                $table->foreignId('announcement_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
                $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
                $table->timestamp('read_at')->nullable();

                $table->unique(['announcement_id','user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcement_user');
    }
};
