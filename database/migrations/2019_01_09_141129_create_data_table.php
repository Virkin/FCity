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
            $table->unsignedInteger('measure_id');
            $table->double('value');
            $table->timestamp('added_on');

            $table->foreign('ride_id')->references('id')->on('ride');
            $table->foreign('measure_id')->references('id')->on('measure');
        });

        DB::statement("ALTER TABLE fcity.`data` MODIFY COLUMN added_on TIMESTAMP(3) DEFAULT CURRENT_TIMESTAMP(3) NOT NULL");
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
