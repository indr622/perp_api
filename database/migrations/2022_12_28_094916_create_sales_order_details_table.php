<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sales_order_id');
            $table->foreignId('product_id');
            $table->double('price_sell');
            $table->integer('qty');
            $table->double('amount', 18, 2)->default(0);
            $table->text('remark')->nullable();
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('sales_order_id')->references('id')->on('sales_orders');
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
        Schema::dropIfExists('sales_order_details');
    }
};
