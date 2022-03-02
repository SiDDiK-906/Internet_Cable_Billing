<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinePaymentMultimonthWiseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('line_payment_multimonth_wise')) {
            Schema::create('line_payment_multimonth_wise', function (Blueprint $table) {
                $table->integer('id')->unsigned()->autoIncrement();

                $table->integer('fk_payment_transition_id')->unsigned();
                $table->foreign('fk_payment_transition_id')->references('id')->on('line_payment_transition_method');

                $table->integer('fk_transition_type_id')->unsigned();
                $table->foreign('fk_transition_type_id')->references('id')->on('line_transition_type');

                $table->string('year');
                $table->string('month');
                $table->integer('discount');
                $table->string('receive_date')->nullable();
                $table->tinyInteger('one_click')->default(0);
                $table->integer('month_wise_amount');
                $table->integer('month_wise_paid');
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
        // Schema::table('line_payment_multimonth_wise', function (Blueprint $table) {
        //     $table->dropForeign(['fk_payment_transition_id']);
        // });

        Schema::dropIfExists('line_payment_multimonth_wise');
    }
}
