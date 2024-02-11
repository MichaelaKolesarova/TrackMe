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
        Schema::table('users', function (Blueprint $table) {
            $table->binary('profile_picture')->default(null)->nullable();
            $table->string('username')->default(null)->nullable();
            $table->string('location')->default(null)->nullable();
            $table->string('phone_number')->default(null)->nullable();
            $table->string('street')->default(null)->nullable();
            $table->string('house_number')->default(null)->nullable();
            $table->string('postcode')->default(null)->nullable();
            $table->string('city')->default(null)->nullable();
            $table->date('birthday')->default(null)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
