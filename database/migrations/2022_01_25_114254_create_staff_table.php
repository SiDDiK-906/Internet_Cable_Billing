<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('staff')) {
            Schema::create('staff', function (Blueprint $table) {
                $table->integer('id')->unsigned()->autoIncrement();
                $table->string('staff_name');
                $table->string('staff_email');
                $table->string('password');
                $table->string('staff_profile')->nullable();
                $table->string('staff_phone_no');
                $table->tinyInteger('staff_status')->default(1);
                $table->text('staff_address')->nullable();
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
        Schema::dropIfExists('staff');
    }
}
