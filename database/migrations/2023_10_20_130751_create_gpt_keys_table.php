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
        Schema::create('gpt_keys', function (Blueprint $table) {
            $table->id();
            $table->longText('key_api')->nullable();
            $table->longText('model')->nullable();
            $table->longText('link')->nullable();
            $table->integer('error')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gpt_keys');
    }
};
