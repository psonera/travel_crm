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
            $table->decimal('price',12,4)->default(0.000);
            $table->string('coupon_code')->nullable();
            $table->decimal('discount_percent',12, 4)->default(0.0000)->nullable();
            $table->decimal('discount_amount',12, 4)->default(0.0000)->nullable();
            $table->decimal('tax_percent',12,4)->default(0.0000)->nullable();
            $table->decimal('tax_amount',12,4)->default(0.0000)->nullable();
            $table->decimal('total',12,4)->default(0.0000);
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
