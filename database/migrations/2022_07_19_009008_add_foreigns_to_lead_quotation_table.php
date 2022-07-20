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
        Schema::table('lead_quotation', function (Blueprint $table) {
            $table
                ->foreign('lead_id')
                ->references('id')
                ->on('leads')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('quotation_id')
                ->references('id')
                ->on('quotations')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lead_quotation', function (Blueprint $table) {
            $table->dropForeign(['lead_id']);
            $table->dropForeign(['quotation_id']);
        });
    }
};
