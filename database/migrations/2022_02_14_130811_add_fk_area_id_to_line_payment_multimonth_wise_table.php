<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddFkAreaIdToLinePaymentMultimonthWiseTable extends Migration
{


    public function up()
    {
        Schema::table('line_payment_multimonth_wise', function (Blueprint $table) {

                $table->integer('fk_area_id')->unsigned()->nullable()->after('id');
                $table->foreign('fk_area_id')->references('id')->on('area_set');

        });

        // DB::statement("UPDATE line_payment_multimonth_wise table1
        //                SET table1.fk_area_id = SUBSTRING(table1.fk_area_id, 1, 10)
        //                WHERE 1");

    }













    public function down()
    {
        Schema::table('line_payment_multimonth_wise', function (Blueprint $table) {
            //
        });
    }
}
