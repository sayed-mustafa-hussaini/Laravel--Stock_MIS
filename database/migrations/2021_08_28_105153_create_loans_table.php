<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('purchase_id')->unsigned()->nullable();
            $table->foreign('purchase_id')
              ->references('id')
              ->on('purchases')->onDelete('cascade');

            $table->bigInteger('bill_id')->unsigned()->nullable();
            $table->foreign('bill_id')
              ->references('id')
              ->on('bills')->onDelete('cascade');
            
            $table->bigInteger('quantity_loan')->nullable();
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
        Schema::dropIfExists('loans');
    }
}
