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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sales_order_id')->nullable();
            $table->foreignId('currency_id');
            $table->foreignId('supplier_id');
            $table->foreignId('pph_id');
            $table->foreignId('term_shipping_id');

            $table->string('po_number', 30)->unique();
            $table->boolean('po_use_vat')->default(false);
            $table->double('po_rate', 12, 2)->nullable();
            $table->date('po_order_date');
            $table->date('po_request_date');
            $table->integer('po_discount_percent');
            $table->double('po_discount_nominal');

            $table
                ->enum("po_type", GlobalConstant::PO_TYPE_OPTIONS)
                ->default(GlobalConstant::PO_TYPE_MATERIAL);
            $table
                ->enum("po_status", GlobalConstant::PO_STATUS_OPTIONS)
                ->default(GlobalConstant::PO_STATUS_PROCESS);


            $table->text('shipping_mark')->nullable();
            $table->text('shipping_name')->nullable();
            $table->text('shipping_email')->nullable();
            $table->text('shipping_phone')->nullable();
            $table->text('shipping_address')->nullable();
            $table->text('term_payment', 50);

            $table->text('created_by')->nullable();
            $table->double('po_subtotal', 12, 2);
            $table->double('po_discount', 12, 2);
            $table->double('po_vat', 12, 2);
            $table->double('po_pph', 12, 2);
            $table->double('po_total', 12, 2);
            $table->timestamps();


            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->foreign('pph_id')->references('id')->on('pphs');
            $table->foreign('term_shipping_id')->references('id')->on('term_shippings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_orders');
    }
};
