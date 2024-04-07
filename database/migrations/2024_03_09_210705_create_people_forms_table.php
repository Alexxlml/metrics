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
        Schema::create('people_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('first_name');
            $table->string('second_name')->nullable();
            $table->string('first_surname');
            $table->string('second_surname')->nullable();
            $table->string('electoral_key', 18)->unique();
            $table->string('phone', 10);
            $table->string('address');
            $table->foreignId('neighborhood_id')->constrained('neighborhoods');
            $table->foreignId('section_id')->constrained('sections');
            $table->boolean('vote');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people_forms');
    }
};
