<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete()->nullable();
            $table->string('username');
            $table->string('phone')->nullable();
            $table->string('email');
            $table->decimal('total_balance',8,2);
            $table->decimal('due_balance',8,2);
            $table->string('type');
            $table->decimal('discount',8,2)->nullable();
            $table->boolean('discount_type')->default(0)->nullable()->comment('flat 0, non flat 1');
            $table->boolean('status')->default(0)->nullable();
            $table->boolean('is_read')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
