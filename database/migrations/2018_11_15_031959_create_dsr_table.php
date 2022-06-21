<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDsrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dsr', function (Blueprint $table) {
          $table->integer('employee_id')->unsigned();
          $table->string('date');
          $table->string('Report_to_office_at');
          $table->string('Customer_Name');
          $table->string('location');
          $table->string('Contact_Person');
          $table->string('Purpose_of_visit');
          $table->string('SWO_or_Call_reference_ID');
          $table->string('Date_of_Work');
          $table->time('Work_start_time');
          $table->time('Work_end_time');
          $table->time('Time_Spent_at_Customer_location');
          $table->string('Report_to_office');
          $table->string('Additional_Remark');
          $table->string('Customer_response_remarks');
          $table->integer('Total_Expense');
          $table->string('From');
          $table->string('To');
          $table->string('Media');
          $table->integer('Travelling_Expense');
          $table->string('Particle_Extra');
          $table->integer('Expense');
          $table->string('With');
          $table->rememberToken();
          $table->timestamps();
          $table->primary(array('employee_id', 'date'));
          $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dsr', function (Blueprint $table) {
            //
        });
    }
}
