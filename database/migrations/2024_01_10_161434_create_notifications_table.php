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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('category',500)->default('Non-communication');
            $table->string('title',500);
            $table->string('message',2000);
            $table->integer('user_id');
            $table->string('admin_call_back_url',500)->nullable();
            $table->boolean('admin_is_read')->default(0);
            $table->string('member_call_back_url',500)->nullable();
            $table->boolean('member_is_read')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
