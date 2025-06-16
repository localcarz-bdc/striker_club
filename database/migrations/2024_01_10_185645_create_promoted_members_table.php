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
        Schema::create('promoted_members', function (Blueprint $table) {
            $table->id();
            $table->string('image',500)->nullable();
            $table->string('name');
            $table->string('designation');
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete()->nullable();
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
        Schema::dropIfExists('promoted_members');
    }
};
