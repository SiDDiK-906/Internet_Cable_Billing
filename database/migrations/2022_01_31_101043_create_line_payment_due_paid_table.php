<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinePaymentDuePaidTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('line_payment_due_paid')) {
            Schema::create('line_payment_due_paid', function (Blueprint $table) {
                $table->integer('id')->autoIncrement();

                $table->integer('fk_month_wise_id')->unsigned();
                $table->foreign('fk_month_wise_id')->references('id')->on('line_payment_multimonth_wise');

                $table->integer('month_wise_amount');
                $table->integer('discount');
                $table->integer('last_due');
                $table->integer('due_paid');
                $table->date('due_payment_date');
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
        Schema::dropIfExists('line_payment_due_paid');
    }
}
