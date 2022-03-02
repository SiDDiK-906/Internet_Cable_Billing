<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinePaymentTransitionMethodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('line_payment_transition_method')) {
            Schema::create('line_payment_transition_method', function (Blueprint $table) {
                $table->integer('id')->unsigned()->autoIncrement();

                $table->integer('fk_staff_id')->unsigned();
                $table->foreign('fk_staff_id')->references('id')->on('staff');

                $table->integer('fk_line_transition_id')->unsigned();

                $table->integer('fk_customer_id')->unsigned();
                $table->foreign('fk_customer_id')->references('id')->on('customer');

                $table->integer('fk_transition_type_id')->unsigned()->nullable();

                $table->string('transition_id')->index('transition_id');

                $table->string('description')->nullable();
                $table->date('payment_date')->nullable();
                $table->integer('paid_amount');
                $table->integer('discount')->default(0);
                $table->integer('due_amount');
                $table->tinyInteger('status');
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
        Schema::dropIfExists('line_payment_transition_method');
    }
}
