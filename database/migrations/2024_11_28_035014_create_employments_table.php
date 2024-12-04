<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
    Schema::create('employments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('resume_id')->constrained()->onDelete('cascade');
        $table->string('company_name');
        $table->string('position');
        $table->year('year_started')->nullable();
        $table->year('year_ended')->nullable(); // nullable for 'Present'
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employments');
    }
};
