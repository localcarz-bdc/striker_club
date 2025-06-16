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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete()->nullable();
            $table->string('fname');
            $table->string('lname');
            $table->date('dob');
            $table->integer('age')->nullable();
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('zip');
            $table->string('telephone');
            $table->string('email');
            $table->decimal('balance',2)->nullable();
            $table->string('marital')->nullable();
            $table->string('spouse')->nullable();
            $table->string('spouse_dob')->nullable();
            $table->string('educational_background')->nullable();
            $table->string('occupation')->nullable();
            $table->string('religious_affiliation')->nullable();
            $table->string('hobbies')->nullable();
            $table->string('other_affiliations')->nullable();
            $table->string('why_desire')->nullable();
            $table->string('name_of_striker')->nullable();
            $table->string('signature_date')->nullable();
            // $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete()->nullable();
            $table->boolean('is_approve')->default(0)->nullable();
            $table->boolean('is_read')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *










     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
