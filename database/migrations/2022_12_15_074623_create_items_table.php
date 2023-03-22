<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Date: 2022-12-12
 */

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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id');
            $table->foreignId('subgroup_id');
            $table->foreignId('unit_id');
            $table->string('name');
            $table->text('specification')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price_sell', 15, 2);
            $table->decimal('price_buy', 15, 2);
            $table->decimal('price_formula', 15, 2);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('group_id')->references('id')->on('groups')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('subgroup_id')->references('id')->on('sub_groups')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('unit_id')->references('id')->on('units')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
};
