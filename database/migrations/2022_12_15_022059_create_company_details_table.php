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
        Schema::create('company_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id');
            $table->string('bank_name', 50);
            $table->string('bank_account_number', 50);
            $table->string('bank_account_name', 50);
            $table->foreign('company_id')->references('id')->on('company_profiles')->onDelete('cascade');
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
        Schema::dropIfExists('company_details');
    }
};
