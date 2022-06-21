<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
          $table->increments('id');
          $table->string('item_code');
          $table->string('pi_number');
          $table->string('customer');
          $table->integer('quantity');
          $table->integer('price');
          $table->datetime('date_sale');
          $table->timestamps();
        });

        // DB::unprepared('ALTER TABLE `sales` ADD PRIMARY KEY (  `item_code` ,  `customer` )');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales', function (Blueprint $table) {
            //
        });
    }
}
