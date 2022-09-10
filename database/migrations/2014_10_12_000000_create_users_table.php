<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->unique()->primary();
            $table->unsignedBigInteger('discord_private_channel_id')->nullable();
            $table->string('name');
            $table->string('nickname');
            $table->string('avatar')->nullable();
            $table->datetime('admin')->nullable();
            $table->datetime('super_admin')->nullable();
            $table->datetime('banned')->nullable();
            $table->datetime('last_activity');
            $table->string('token');
            $table->datetime('token_expires_at');
            $table->string('refresh_token');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
