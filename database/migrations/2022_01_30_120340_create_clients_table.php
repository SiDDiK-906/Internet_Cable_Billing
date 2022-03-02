<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('clients')) {
            Schema::create('clients', function (Blueprint $table) {
                $table->integer('id')->unsigned()->autoIncrement();
                $table->string('client_id')->index('client_id')->unique()->nullable();
                $table->string('client_name');
                $table->string('mobile_no')->nullable();
                $table->string('address')->nullable();
                $table->string('email_id')->nullable();
                $table->string('client_type')->nullable();
                $table->integer('client_status')->nullable()->default(0);
                $table->string('company_name')->nullable();
                $table->integer('created_by')->nullable()->unsigned();
                $table->integer('updated_by')->nullable()->unsigned();

                $table->timestamps();
                $table->string('deleted_at')->useCurrent(Carbon::now()->timestamp)->nullable();
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
        Schema::dropIfExists('clients');
    }
}
