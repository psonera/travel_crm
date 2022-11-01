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
            $table->String('created_by')->nullable();
            $table->string('subject');
            $table->string('description');
            $table->longText('billing_address');
            $table->longText('shipping_address');
            $table->decimal('discount_percent',12,4)->default(0.000);
            $table->decimal('discount_amount',12,4)->nullable();
            $table->decimal('tax_amount',12,4)->nullable();
            $table->decimal('sub_total',12,4)->nullable();
            $table->decimal('grand_total',12,4)->nullable();
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
