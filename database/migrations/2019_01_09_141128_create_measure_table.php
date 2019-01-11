<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeasureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('measure', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sensor_id');
            $table->string('name');
            $table->string('unit');
            $table->timestamps();

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
        Schema::dropIfExists('measure');
    }
}
