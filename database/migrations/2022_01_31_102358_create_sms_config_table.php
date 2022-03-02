<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('sms_config')) {
            Schema::create('sms_config', function (Blueprint $table) {
                $table->integer('id')->autoIncrement();
                $table->longText('sms_quantity');
                $table->longText('user_name');
                $table->longText('password');
                $table->longText('from');
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
        Schema::dropIfExists('sms_config');
    }
}
