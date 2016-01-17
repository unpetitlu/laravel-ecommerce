<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('image_task', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('image_id')->unsigned()->index();
            $table->foreign('image_id')->references('id')->on('image');

            $table->integer('task_id')->unsigned()->index();
            $table->foreign('task_id')->references('id')->on('task');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('image');
    }
}
