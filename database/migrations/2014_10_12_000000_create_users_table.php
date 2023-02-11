<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('guard')->nullable()->default('client');
            $table->enum('user_type', ['web', 'business', 'client']);
            $table->timestamp('last_login')->nullable();
            $table->boolean('online')->nullable()->default(false);
            $table->boolean('verified')->nullable()->default(false);
            $table->boolean('active')->nullable()->default(false);
            $table->boolean('subscription')->nullable()->default(false);
            $table->string('profile_image')->nullable()->default('user.png');
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
}
