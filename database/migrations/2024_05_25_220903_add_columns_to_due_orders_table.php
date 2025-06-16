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
        Schema::table('due_orders', function (Blueprint $table) {
            $table->integer('pay_type')->comment('1 = card, 2=cash 3= check');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('due_orders', function (Blueprint $table) {
            $table->dropColumn(['pay_type']);
        });
    }
};
