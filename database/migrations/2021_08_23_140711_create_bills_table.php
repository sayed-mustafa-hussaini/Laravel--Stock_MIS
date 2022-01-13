<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('bill_num')->nullable();

            $table->bigInteger('customer_id')->unsigned()->nullable();
            $table->foreign('customer_id')
              ->references('id')
              ->on('customers')->onDelete('cascade');
        
            $table->integer('quantity_goods')->nullable();
            $table->bigInteger('total_price')->nullable();
            $table->bigInteger('money_paid')->nullable();
            $table->bigInteger('money_remaining')->nullable();
            $table->string('currency')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('bills');
    }
}
