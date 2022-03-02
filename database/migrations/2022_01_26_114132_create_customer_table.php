<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('customer')) {
            Schema::create('customer', function (Blueprint $table) {
                $table->integer('id')->unsigned()->autoIncrement();

                $table->integer('fk_area_id')->unsigned();
                $table->foreign('fk_area_id')->references('id')->on('area_set');

                $table->integer('fk_line_id')->unsigned();
                $table->foreign('fk_line_id')->references('id')->on('line_category');

                $table->string('customer_id')->nullable();
                $table->string('line_number')->nullable();
                $table->string('customer_name');
                $table->string('customer_email')->nullable();
                $table->text('address')->nullable();
                $table->string('customer_phone')->nullable();
                $table->string('customer_nid')->nullable();
                $table->float('customer_due')->nullable();
                $table->tinyInteger('status')->default(1);
                $table->date('starting_date')->nullable();
                $table->date('connection_date');

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
        Schema::dropIfExists('customer');
    }
}
