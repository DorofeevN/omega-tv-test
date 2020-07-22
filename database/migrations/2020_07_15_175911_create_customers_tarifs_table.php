<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTarifsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('customers_tarifs', function (Blueprint $table) {
          $table->id()->unsigned();
          $table->bigInteger('customer_id')->unsigned();
          $table->bigInteger('tarif_id')->unsigned();
          $table->boolean('active');

          // $table->foreign('customer_id')->references('id')->on('customers');
          // $table->foreign('tarif_id')->references('id')->on('tarifs');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers_tarifs');
    }
}
