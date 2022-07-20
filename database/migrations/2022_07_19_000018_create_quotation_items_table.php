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
        Schema::create('quotation_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sku');
            $table->string('name');
            $table->integer('quantity')->default(0);
            $table->integer('price')->default(0);
            $table->string('coupon_code');
            $table->decimal('discount_percent', 4)->default(0.0);
            $table->decimal('discount_amount', 4)->default(0.0);
            $table->decimal('tax_percent', 4)->default(0.0);
            $table->decimal('tax_amount', 4)->default(0.0);
            $table->decimal('total', 4)->default(0.0);
            $table->foreignId('product_id');
            $table->foreignId('quotation_id');

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
        Schema::dropIfExists('quotation_items');
    }
};
