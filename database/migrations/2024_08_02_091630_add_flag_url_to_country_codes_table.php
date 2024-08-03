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
        Schema::table('country_codes', function (Blueprint $table) {
            $table->string('flag_url')->after('country_code')->nullable(); // Adding flag_url column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('country_codes', function (Blueprint $table) {
            //
        });
    }
};
