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
        Schema::table('activity_lead', function (Blueprint $table) {
            $table
                ->foreign('lead_id')
                ->references('id')
                ->on('leads')
                ->nullOnDelete();

            $table
                ->foreign('activity_id')
                ->references('id')
                ->on('activities')
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
        Schema::table('activity_lead', function (Blueprint $table) {
            $table->dropForeign(['lead_id']);
            $table->dropForeign(['activity_id']);
        });
    }
};
