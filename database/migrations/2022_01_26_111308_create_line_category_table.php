<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLineCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('line_category')) {
            Schema::create('line_category', function (Blueprint $table) {
                $table->integer('id')->unsigned()->autoIncrement();
                $table->string('line_name');
                $table->integer('line_amount');
                $table->tinyInteger('line_status')->default(0);
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
        Schema::dropIfExists('line_category');
    }
}
