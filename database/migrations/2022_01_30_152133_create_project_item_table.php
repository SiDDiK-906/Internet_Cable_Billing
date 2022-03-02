<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('project_item')) {
            Schema::create('project_item', function (Blueprint $table) {
                $table->integer('id')->unsigned()->autoIncrement();
                $table->string('project_name');
                $table->string('project_description')->nullable();
                $table->string('project_type');
                $table->integer('project_status')->default(0);
                $table->string('company_name')->nullable();
                $table->integer('created_by')->nullable()->unsigned();
                $table->integer('updated_by')->nullable()->unsigned();
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
        Schema::dropIfExists('project_item');
    }
}
