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
        Schema::create('bot_chats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bot_id')->nullable()->constrained('bots')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('id_telegram')->nullable();
            $table->string('name', 255)->nullable();
            $table->string('nicname', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bot_chats');
    }
};
