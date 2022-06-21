<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
          $table->integer('id')->unsigned();
          $table->string('fname');
          $table->string('lname');
          $table->string('email')->unique();
          $table->string('password');
          $table->string('addr1');
          $table->string('addr2');
          $table->string('city');
          $table->string('state');
          $table->integer('zip');
          $table->string('contact_no');
          $table->string('dob');
          $table->string('doj');
          $table->rememberToken();
          $table->timestamps();
          $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee', function (Blueprint $table) {
            //
        });
    }
}
