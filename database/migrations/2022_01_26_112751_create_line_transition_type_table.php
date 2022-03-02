<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLineTransitionTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('line_transition_type')) {
            Schema::create('line_transition_type', function (Blueprint $table) {
                $table->integer('id')->unsigned()->autoIncrement();
                $table->string('cost_category_name');
                $table->integer('cost_amount')->default(0);
                $table->text('description')->nullable();
                $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('line_transition_type');
    }
}
