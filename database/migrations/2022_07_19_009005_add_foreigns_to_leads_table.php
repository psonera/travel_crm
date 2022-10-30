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
        Schema::table('leads', function (Blueprint $table) {
            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();

            $table
                ->foreign('lead_manager_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();

            $table
                ->foreign('lead_source_id')
                ->references('id')
                ->on('lead_sources')
                ->nullOnDelete();

            $table
                ->foreign('lead_type_id')
                ->references('id')
                ->on('lead_types')
                ->nullOnDelete();

            $table
                ->foreign('lead_pipeline_stage_id')
                ->references('id')
                ->on('lead_pipeline_stages')
                ->nullOnDelete();

            $table
                ->foreign('trip_id')
                ->references('id')
                ->on('trips')
                ->nullOnDelete();

            $table
                ->foreign('trip_type_id')
                ->references('id')
                ->on('trip_types')
                ->nullOnDelete();

            $table
                ->foreign('accomodation_id')
                ->references('id')
                ->on('accomodations')
                ->nullOnDelete();

            $table
                ->foreign('transport_id')
                ->references('id')
                ->on('transports')
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
        Schema::table('leads', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['lead_manager_id']);
            $table->dropForeign(['lead_source_id']);
            $table->dropForeign(['lead_type_id']);
            $table->dropForeign(['trip_id']);
            $table->dropForeign(['trip_type_id']);
            $table->dropForeign(['accomodation_id']);
            $table->dropForeign(['transport_id']);
        });
    }
};
