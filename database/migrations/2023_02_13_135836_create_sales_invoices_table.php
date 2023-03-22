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
        Schema::create('sales_invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sales_order_id')->nullable();
            $table->unsignedBigInteger('purchase_shipping_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();

            $table->string('inv_number', 30)->unique();
            $table->string('document_no', 50)->nullable();
            $table->date('inv_date');
            $table->date('inv_delivery_date');

            $table
                ->enum("inv_status", GlobalConstant::INV_STATUS_OPTIONS)
                ->default(GlobalConstant::INV_STATUS_UNPAID);
            $table->text('shipping_name')->nullable();
            $table->text('shipping_email')->nullable();
            $table->text('shipping_phone')->nullable();
            $table->text('shipping_address')->nullable();
            $table->text('term_payment', 50);

            $table->text('created_by')->nullable();
            $table->double('inv_subtotal', 18, 2);
            $table->double('inv_discount', 18, 2);
            $table->double('inv_additional_cost', 18, 2);
            $table->double('inv_vat', 18, 2);
            $table->double('inv_prepaid', 18, 2)->default(0);
            $table->double('inv_total', 18, 2);
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
        Schema::dropIfExists('sales_invoices');
    }
};
