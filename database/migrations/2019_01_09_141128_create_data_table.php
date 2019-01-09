<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ride_id');
            $table->unsignedInteger('sensor_id');
            $table->double('value');
            $table->timestamps();

            $table->foreign('ride_id')->references('id')->on('ride');
            $table->foreign('sensor_id')->references('id')->on('sensor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data');
    }
}
