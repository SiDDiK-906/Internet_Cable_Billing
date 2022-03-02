<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('company_info')) {
            Schema::create('company_info', function (Blueprint $table) {
                $table->integer('id')->unsigned()->autoIncrement();
                $table->string('company_name');
                $table->string('web_address')->nullable();
                $table->text('company_address')->nullable();
                $table->string('company_email')->nullable();
                $table->string('company_phone')->nullable();
                $table->string('company_logo')->nullable();
                $table->string('company_icon')->nullable();
                $table->string('fb_page_link')->nullable();
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
        Schema::dropIfExists('company_info');
    }
}
