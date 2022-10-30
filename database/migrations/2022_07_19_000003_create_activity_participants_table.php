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
        Schema::create('activity_participants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('activity_id');
            $table->foreignId('user_id')->nullable();
            $table->foreignId('lead_manager_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activity_participants');
    }
};
