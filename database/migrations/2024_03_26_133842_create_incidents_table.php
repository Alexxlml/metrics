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
        Schema::create('incidents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->constrained('people_forms')->cascadeOnDelete();
            $table->foreignId('boss_id')->constrained('users');
            $table->foreignId('subordinate_id')->constrained('users');
            $table->string('field_to_change');
            $table->string('description_of_field');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidents');
    }
};
