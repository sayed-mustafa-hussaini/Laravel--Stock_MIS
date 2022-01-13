<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_histories', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('goods_id')->unsigned()->nullable();
            $table->foreign('goods_id')
              ->references('id')
              ->on('goods')->onDelete('cascade');

            $table->bigInteger('quantity_goods');
            $table->string('status');

            $table->bigInteger('employee_id')->unsigned()->nullable();
            $table->foreign('employee_id')
              ->references('id')
              ->on('employees')
              ->onDelete('cascade');

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
        Schema::dropIfExists('stock_histories');
    }
}
