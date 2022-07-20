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
        Schema::create('lead_managers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('email');
            $table->longText('contact_number');
            $table->foreignId('lead_source_id');

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
        Schema::dropIfExists('lead_managers');
    }
};
