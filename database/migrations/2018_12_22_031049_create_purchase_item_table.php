<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
          $table->string('item_code');
          $table->string('item_name');
          $table->string('purchase_order_number');
          $table->string('sub_type_1');
          $table->string('sub_type_2');
          $table->string('sub_type_3');
          $table->string('company');
          $table->integer('quantity');
          $table->integer('price');
          $table->datetime('date_purchase');
          $table->timestamps();
          $table->primary('item_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchases', function (Blueprint $table) {
            //
        });
    }
}
