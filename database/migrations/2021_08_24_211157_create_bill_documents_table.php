<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_documents', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('bill_id')->unsigned()->nullable();
            $table->foreign('bill_id')
              ->references('id')
              ->on('bills')->onDelete('cascade');

            $table->bigInteger('goods_id')->unsigned()->nullable();
            $table->foreign('goods_id')
              ->references('id')
              ->on('goods')->onDelete('cascade');
            
            $table->bigInteger('goods_price')->nullable();
            $table->bigInteger('quantity_goods')->nullable();
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
        Schema::dropIfExists('bill_documents');
    }
}
