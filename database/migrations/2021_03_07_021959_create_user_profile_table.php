<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfileTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('user_profile', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('user_id');
      $table->string('name')->nullable();
      $table->string('address')->nullable();
      $table->string('contact')->nullable();
      $table->string('contact_person')->nullable();
      $table->string('mobile')->nullable();
      $table->string('cover_image')->nullable()->default('default.jpg');
      $table->text('description')->nullable();
      $table->text('summary')->nullable();
      $table->text('categories')->nullable();
      $table->text('map')->nullable();
      $table->timestamps();

      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });


  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('user_profile');
  }
}
