<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeModulePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_module', function (Blueprint $table) {
          $table->integer('id')->unsigned();
          $table->integer('employee_id')->unsigned();
          $table->integer('module_id')->unsigned();
          $table->foreign('module_id')->references('id')->on('modules')->onDelete('cascade');
          $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
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
        Schema::table('employee_module', function (Blueprint $table) {
            //
        });
    }
}
