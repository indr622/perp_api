<?php

use App\Constant\GlobalConstant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_shippings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_order_id');

            $table->string('shp_number', 30)->unique();
            $table->date('shp_request_date');
            $table->string('created_by');
            $table->text('note')->nullable();
            $table->double('shp_subtotal', 12, 2);
            $table->double('shp_discount', 12, 2);
            $table->double('shp_vat', 12, 2);
            $table->double('shp_pph', 12, 2);
            $table->double('shp_total', 12, 2);
            $table
                ->enum("shp_status", GlobalConstant::SHP_STATUS_OPTIONS)
                ->default(GlobalConstant::SHP_STATUS_PROCESS);
            $table->timestamps();
            $table->foreign('purchase_order_id')->references('id')->on('purchase_orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_shippings');
    }
};
