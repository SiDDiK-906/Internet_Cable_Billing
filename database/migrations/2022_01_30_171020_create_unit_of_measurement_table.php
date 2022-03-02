<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitOfMeasurementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('unit_of_measurement')) {
            Schema::create('unit_of_measurement', function (Blueprint $table) {
                $table->integer('id')->unsigned()->autoIncrement();
                $table->string('uom_name')->nullable();
                $table->tinyInteger('status')->nullable()->default(0);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unit_of_measurement');
    }
}
