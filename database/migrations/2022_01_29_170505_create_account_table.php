<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('account')) {
            Schema::create('account', function (Blueprint $table) {
                $table->integer('id')->unsigned()->autoIncrement();
                $table->string('account_name');
                $table->decimal('current_balance', 15, 2);
                $table->text('account_description')->nullable();
                $table->tinyInteger('account_status')->default(0);
                $table->string('company_name')->nullable();
                $table->integer('created_by')->unsigned()->nullable();
                $table->integer('updated_by')->unsigned()->nullable();

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
        Schema::dropIfExists('account');
    }
}
