<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUiModuleTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ui_module', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name', 128);
            $table->string('module', 64);
            $table->string('route', 255);
            $table->timestamps();
        });

        Schema::create('ui_module_action', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('ui_module_id')->unsigned();
            $table->string('name', 128);
            $table->string('action', 64);
            $table->string('link', 255);

            $table->timestamps();

            $table->foreign('ui_module_id')->references('id')->on('ui_module');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ui_module');
    }

}
