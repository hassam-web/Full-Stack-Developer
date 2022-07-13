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
            $table->id('user_id');
            $table->string('username',200);
            $table->string('password',200);
            $table->string('user_firstname',200)->nullable();
            $table->string('user_lastname',200)->nullable();
            $table->string('email',200);
            $table->longText('user_image')->nullable();
            $table->string('user_role',100);
            $table->string('token',100)->nullable();
            $table->integer('is_online')->nullable();
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