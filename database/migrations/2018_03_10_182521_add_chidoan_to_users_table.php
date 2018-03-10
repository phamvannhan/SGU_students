<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddChidoanToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger("is_chidoan")->default(0);
            $table->tinyInteger("is_doanvien")->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_chidoan');
            $table->dropColumn('is_doanvien');
        });
    }
}
