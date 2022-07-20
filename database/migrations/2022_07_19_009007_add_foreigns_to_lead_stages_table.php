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
        Schema::table('lead_stages', function (Blueprint $table) {
            $table
                ->foreign('lead_pipeline_id')
                ->references('id')
                ->on('lead_pipelines')
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
        Schema::table('lead_stages', function (Blueprint $table) {
            $table->dropForeign(['lead_pipeline_id']);
        });
    }
};
