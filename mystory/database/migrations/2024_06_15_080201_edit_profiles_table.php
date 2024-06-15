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
        Schema::create('profiles', function (Blueprint $table) {
            $table->string('username')->unique();
            $table->string('avatar')->nullable();
            $table->date('dob')->nullable();
            $table->text('bio')->nullable();
            $table->string('gender')->nullable();
            $table->unsignedBigInteger('uid')->unique();
            $table->foreign('uid')->references('id')->on('users')->onDelete('cascade');
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
