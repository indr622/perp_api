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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id');
            $table->foreignId('retailer_id');
            $table->foreignId('unit_id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->double('thick');
            $table->double('width');
            $table->double('length');
            $table->double('flap')->nullable();
            $table->string('gusset')->nullable();
            $table->string('pillow_bag')->nullable();
            $table->double('pillow_fold')->nullable();
            $table->double('airhole')->nullable();
            $table->double('sealtape')->nullable();
            $table->string('sealtape_type')->nullable();
            $table->boolean('perforation')->default(true);
            $table->boolean('printing')->default(true);
            $table->text('color')->nullable();
            $table->double('price', 18, 2);
            $table->double('price_buy', 18, 2);
            $table->boolean('is_active')->default(true);
            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('unit_id')->references('id')->on('units');
            $table->foreign('retailer_id')->references('id')->on('retailers');
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
        Schema::dropIfExists('products');
    }
};
