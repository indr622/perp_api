<?php

use App\Constant\GlobalConstant;
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
        Schema::create('sales_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quotation_id')->nullable();
            $table->foreignId('currency_id');
            $table->foreignId('customer_id');
            $table->foreignId('type_order_id');
            $table->foreignId('retailer_id');

            $table->string('customer_po', 50)->nullable();
            $table->string('so_number', 30)->unique();
            $table->boolean('so_use_vat')->default(false);
            $table->double('so_rate', 12, 2)->nullable();
            $table->date('so_order_date');
            $table->date('so_request_date');
            $table->integer('so_discount_percent');
            $table->double('so_discount_nominal');

            $table->double('so_subtotal', 20, 2);
            $table->double('so_discount', 20, 2);
            $table->double('so_additional_cost', 20, 2);
            $table->double('so_vat', 20, 2);
            $table->double('so_total', 20, 2);
            $table->text('so_shipping_name');
            $table->text('so_shipping_email');
            $table->text('so_shipping_phone');
            $table->text('so_shipping_address');
            $table
                ->enum("so_status", GlobalConstant::SO_STATUS_OPTIONS)
                ->default(GlobalConstant::SO_STATUS_PENDING);

            $table->text('so_term_payment', 50);
            $table->text('so_term_and_condition')->nullable();
            $table->string('so_created_by', 50);
            $table->timestamps();
            $table->foreign('retailer_id')->references('id')->on('retailers');
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('type_order_id')->references('id')->on('type_orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_orders');
    }
};
