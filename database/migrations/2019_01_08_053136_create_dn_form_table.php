<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDnFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dnforms', function (Blueprint $table) {
          $table->increments('id');
          $table->string('Entitlement');
          $table->string('Reason_For_Claim');
          $table->string('Service_Order_No');
          $table->string('Equipment_Serial_No');
          $table->string('Equipment_Description');
          $table->string('Equipment');
          $table->string('Customer_Name');
          $table->string('Customer_Location');
          $table->string('Modality');
          $table->string('Machine');
          $table->string('Local_Or_Outstation');
          $table->string('Invoice_Value');
          $table->string('Claim');
          $table->string('Invoice_No_Sales_No_Contract_No');
          $table->string('Cheque_RTGS');
          $table->string('Remarks');
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
        Schema::table('dnforms', function (Blueprint $table) {
            //
        });
    }
}
