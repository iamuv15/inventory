<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory', function (Blueprint $table) {
          $table->string('item_code');
          $table->string('item_name');
          $table->string('sub_type_1');
          $table->string('sub_type_2');
          $table->string('sub_type_3');
          $table->string('company');
          $table->integer('quantity');
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
        Schema::table('inventory', function (Blueprint $table) {
            //
        });
    }
}
