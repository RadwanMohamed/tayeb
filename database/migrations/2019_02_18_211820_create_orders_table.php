<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('price');
            $table->integer('quantity');
            $table->string('status')->default(\App\Order::NEW);
            $table->string('subtotal');
            $table->integer('product_id')->unsigned();
            $table->integer('cuttersize_id')->unsigned();
            $table->integer('cutterkind_id')->unsigned();
            $table->integer('request_id')->unsigned();
            $table->timestamps();
            $table->foreign('cuttersize_id')->references('id')->on('cutter_sizes');
            $table->foreign('cutterkind_id')->references('id')->on('cutter_kinds');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('request_id')->references('id')->on('requests');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
