<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('category')) {
            Schema::create('category', function (Blueprint $table) {
                $table->integer('id')->unsigned()->autoIncrement();
                $table->string('category_name');
                $table->string('company_name')->nullable();
                $table->string('category_type')->nullable();
                $table->tinyInteger('category_status')->comment('0=inactive, 1=active');
                $table->integer('created_by')->nullable()->comment('user table id ');
                $table->integer('updated_by')->nullable()->comment('user table id ');
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
        Schema::dropIfExists('category');
    }
}
