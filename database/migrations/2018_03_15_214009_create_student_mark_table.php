<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentMarkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    
        Schema::create('student_mark', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("marks_id")->unsigned();
            $table->char("students_id", 15);

            $table->foreign('marks_id')
                ->references('id')->on('marks')
                ->onDelete('cascade');

            $table->foreign('students_id')
                ->references('id')->on('students')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_mark', function (Blueprint $table) {
            //
        });
    }
}
