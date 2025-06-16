<?php

use App\Models\DebutanteMembership;
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
        Schema::create('debutante_membership_info', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(DebutanteMembership::class)->constrained()->cascadeOnDelete()->nullable();
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('attend_or_graduate');
            $table->string('attending_college_now');
            $table->float('current_gpa');
            $table->text('why_debutante');
            $table->text('have_escort_details');
            $table->text('philosophy_of_life');
            $table->text('how_learn_debutante_program');
            $table->string('program_category');
            $table->string('name_of_striker');
            $table->string('signature_name_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('debutante_membership_info');
    }
};
