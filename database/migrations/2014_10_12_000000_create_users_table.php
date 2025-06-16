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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('image',500)->nullable();
            $table->string('password_reset_otp')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->tinyInteger('role')->default(0);
            $table->rememberToken()->nullable();
            $table->string('designation')->nullable();
            $table->decimal('total_balance',8,0)->nullable();
            $table->decimal('paid_balance',8,0)->nullable();
            $table->decimal('due_balance',8,0)->nullable();
            $table->string('type')->nullable();
            $table->boolean('status')->default(0)->comment('Active 1, Inactive 0');
            $table->boolean('is_read')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
