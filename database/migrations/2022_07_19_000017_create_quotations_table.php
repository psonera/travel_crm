<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('subject');
            $table->text('description');
            $table->longText('billing_address');
            $table->longText('shipping_address');
            $table->integer('discount_percent')->default(0);
            $table->integer('discount_amount');
            $table->integer('tax_amount');
            $table->integer('adjustment_amount');
            $table->integer('sub_total');
            $table->integer('grand_total');
            $table->foreignId('lead_manager_id');
            $table->foreignId('user_id');

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
        Schema::dropIfExists('quotations');
    }
};
