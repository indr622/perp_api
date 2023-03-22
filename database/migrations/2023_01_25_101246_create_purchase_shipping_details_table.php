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
        Schema::create('purchase_shipping_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_shipping_id');
            $table->unsignedBigInteger('purchase_order_detail_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('item_id')->nullable();
            $table->double('price', 12, 2)->nullable();
            $table->integer('qty')->default(0);
            $table->integer('qty_delivery')->default(0);
            $table->text('remark')->nullable();
            $table->foreign('purchase_shipping_id')->references('id')->on('purchase_shippings');
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
        Schema::dropIfExists('purchase_shipping_details');
    }
};
