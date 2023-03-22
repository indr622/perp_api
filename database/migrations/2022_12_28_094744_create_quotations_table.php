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
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('currency_id');
            $table->foreignId('customer_id');
            $table->foreignId('type_order_id');
            $table->foreignId('retailer_id');

            $table->string('customer_po', 50)->nullable();
            $table->string('quo_number', 30)->unique();
            $table->boolean('quo_use_vat')->default(false);
            $table->double('quo_rate', 12, 2)->nullable();
            $table->date('quo_order_date');
            $table->date('quo_request_date');
            $table->integer('quo_discount_percent');
            $table->double('quo_discount_nominal');

            $table->double('quo_subtotal', 20, 2);
            $table->double('quo_discount', 20, 2);
            $table->double('quo_additional_cost', 20, 2);
            $table->double('quo_vat', 20, 2);
            $table->double('quo_total', 20, 2);
            $table->text('quo_shipping_name')->nullable();
            $table->text('quo_shipping_email')->nullable();
            $table->text('quo_shipping_phone')->nullable();
            $table->text('quo_shipping_address')->nullable();
            $table
                ->enum("quo_status", GlobalConstant::QUO_STATUS_OPTIONS)
                ->default(GlobalConstant::QUO_STATUS_PENDING);

            $table->text('quo_term_payment', 50)->nullable();
            $table->text('quo_term_and_condition')->nullable();
            $table->string('quo_created_by', 50);
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
        Schema::dropIfExists('quotations');
    }
};
