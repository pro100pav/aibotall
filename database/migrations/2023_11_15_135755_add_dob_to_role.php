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
        Schema::table('bot_chats', function (Blueprint $table) {
            $table->tinyInteger('role')->default(1);
            $table->tinyInteger('requests')->default(10);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bot_chats', function (Blueprint $table) {
            $table->dropColumn("role");
            $table->dropColumn("requests");
        });
    }
};
