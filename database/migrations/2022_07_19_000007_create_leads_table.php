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
        Schema::create('leads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('lead_value')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->integer('traveler_count');
            $table->date('selected_trip_date');
            $table->dateTime('closed_at')->nullable();
            $table->foreignId('user_id');
            $table->foreignId('lead_manager_id');
            $table->foreignId('lead_source_id');
            $table->foreignId('lead_type_id');
            $table->foreignId('lead_pipeline_stage_id');
            $table->foreignId('trip_id');
            $table->foreignId('trip_type_id');
            $table->foreignId('accomodation_id');
            $table->foreignId('transport_id');
            $table->date('expected_closed_date');

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
        Schema::dropIfExists('leads');
    }
};
