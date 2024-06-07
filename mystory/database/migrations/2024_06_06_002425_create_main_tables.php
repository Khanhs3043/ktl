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
            $table->string('avatar');
            $table->date('dob');
            $table->text('bio');
            $table->string('gender');
            $table->unsignedBigInteger('uid');
            $table->foreign('uid')->references('id')->on('users')->onDelete('cascade');
            $table->id();
            $table->timestamps();
        });

        Schema::create('groups', function (Blueprint $table) {
            $table->string('name');
            $table->unsignedBigInteger('creator_id');
            $table->id();
            $table->timestamps();
            $table->foreign('creator_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('friends', function (Blueprint $table) {
            $table->unsignedBigInteger('friend_id');
            $table->unsignedBigInteger('uid');
            $table->id();
            $table->timestamps();
            $table->foreign('friend_id')->references('id')->on('friends')->onDelete('cascade');
            $table->foreign('uid')->references('id')->on('users')->onDelete('cascade');
        });
        
        Schema::create('user_groups', function (Blueprint $table) {
            $table->unsignedBigInteger('uid');
            $table->unsignedBigInteger('group_id');
            $table->id();
            $table->timestamps();
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->foreign('uid')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('blogs', function (Blueprint $table) {
            $table->unsignedBigInteger('uid');
            $table->string('title');
            $table->text('content');
            $table->string('image');
            $table->id();
            $table->timestamps();
            
            $table->foreign('uid')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('uid');
            $table->string('title');
            $table->text('des');
            $table->string('status');
            $table->timestamp('due_date');
            $table->unsignedBigInteger('assign_to');
            $table->id();
            $table->timestamps();            
            $table->foreign('uid')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('friend_requests', function (Blueprint $table) {
            $table->unsignedBigInteger('sender_id');
            $table->unsignedBigInteger('receiver_id');
            $table->string('status');
            $table->id();
            $table->timestamps();            
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('appointments', function (Blueprint $table) {
            $table->unsignedBigInteger('dater_id');
            $table->unsignedBigInteger('dateee_id');
            $table->string('title');
            $table->text('des');
            $table->timestamp('start');
            $table->timestamp('end');
            $table->id();
            $table->timestamps();            
            $table->foreign('dater_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('dateee_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
        Schema::dropIfExists('groups');
        Schema::dropIfExists('friends');
        Schema::dropIfExists('user_groups');
        Schema::dropIfExists('blogs');
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('friend_requests');
        Schema::dropIfExists('appointments');
    }
};
