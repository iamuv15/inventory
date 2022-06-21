<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKerberosAuthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kerberos_auth', function (Blueprint $table) {
          $table->increments('id');
          $table->string('email')->unique();
          $table->string('encrypted');
          $table->datetime('valid_time');
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
        Schema::table('kerberos_auth', function (Blueprint $table) {
            //
        });
    }
}
