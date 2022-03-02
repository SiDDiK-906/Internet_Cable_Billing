<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffAsignAreaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('staff_asign_area')) {
            Schema::create('staff_asign_area', function (Blueprint $table) {
                $table->integer('id')->unsigned()->autoIncrement();

                $table->integer('fk_staff_id')->unsigned();
                $table->foreign('fk_staff_id')->references('id')->on('staff');

                $table->integer('fk_area_id')->unsigned();
                $table->foreign('fk_area_id')->references('id')->on('area_set');

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
        Schema::dropIfExists('staff_asign_area');
    }
}
