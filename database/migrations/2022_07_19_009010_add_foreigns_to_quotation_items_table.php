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
        Schema::table('quotation_items', function (Blueprint $table) {
            $table->unsignedBigInteger('quotation_id')->after('id');
            $table
                ->foreign('quotation_id')
                ->references('id')
                ->on('quotations')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table->foreignId('product_id')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quotation_items', function (Blueprint $table) {
            $table->dropForeign(['quotation_id']);
        });
    }
};
