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
        Schema::table('lead_products', function (Blueprint $table) {
            $table
                ->foreign('lead_id')
                ->references('id')
                ->on('leads')
                ->nullOnDelete();

            $table
                ->foreign('product_id')
                ->references('id')
                ->on('products')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lead_products', function (Blueprint $table) {
            $table->dropForeign(['lead_id']);
            $table->dropForeign(['product_id']);
        });
    }
};
