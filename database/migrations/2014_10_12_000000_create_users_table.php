<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string("students_code", 50)->index()->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->date('birthday')->nullable();
            $table->tinyInteger("active")->default(0);
            $table->string('phone', 15)->nullable();
            $table->string('address')->nullable();
            $table->string('facebook')->nullable();
            $table->integer('city_id')->nullable();
            $table->dateTime("last_logon")->nullable();
            $table->string('avatar')->nullable();
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
