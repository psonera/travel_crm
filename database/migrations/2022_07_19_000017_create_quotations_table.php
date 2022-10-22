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
            $table->string('description');
            $table->longText('billing_address');
            $table->longText('shipping_address');
            $table->decimal('discount_percent',12,4)->default(0.000);
            $table->integer('discount_amount')->nullable();
            $table->integer('tax_amount')->nullable();
            $table->integer('sub_total')->nullable();
            $table->integer('grand_total')->nullable();
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
