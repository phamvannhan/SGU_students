<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->char("id", 15)->index()->unique();
            $table->string('name');
            $table->string('gender')->nullable();
            $table->string('email')->unique();
            $table->date('birthday')->nullable();
            $table->date('start_doanvien')->nullable();
            $table->tinyInteger('active')->default(1); 
            $table->integer('class_id')->unsigned();
            $table->string('phone', 15)->nullable();
            $table->string('address')->nullable();
            $table->tinyInteger("is_doanvien")->default(0);//ko là dvien
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
        Schema::table('students', function (Blueprint $table) {
            //
        });
    }
}
