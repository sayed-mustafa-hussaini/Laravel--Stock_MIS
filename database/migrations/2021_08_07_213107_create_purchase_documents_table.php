<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_documents', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('goods_id')->unsigned()->nullable();
            $table->foreign('goods_id')
             ->references('id')
             ->on('goods')->onDelete('cascade');

            $table->bigInteger('purchase_id')->unsigned()->nullable();
            $table->foreign('purchase_id')
              ->references('id')
              ->on('purchases')->onDelete('cascade');

            $table->bigInteger('price');
            $table->integer('goods_quantity');
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
        Schema::dropIfExists('purchase_documents');
    }
}
