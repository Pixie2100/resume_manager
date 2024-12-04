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
    Schema::table('resumes', function (Blueprint $table) {
        $table->string('photo')->nullable(); // Add the photo column (nullable to allow empty)
    });
}

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('resumes', function (Blueprint $table) {
            $table->dropColumn('photo'); // Remove the photo column if rolling back
        });
    }
};
