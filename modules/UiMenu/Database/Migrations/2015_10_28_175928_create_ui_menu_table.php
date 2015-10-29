<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUiMenuTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ui_menu', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name', 128);
            $table->tinyInteger('admin')->default(0);
            $table->timestamps();
        });

        Schema::create('ui_menu_item', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('ui_menu_id')->unsigned();
            $table->integer('parent_id')->nullable();
            $table->string('name', 128);
            $table->tinyInteger('menu_type')->default(0);
            $table->string('link', 128);
            $table->tinyInteger('target')->default(0);
            $table->integer('position')->nullable();
            $table->timestamps();
            $table->foreign('ui_menu_id')->references('id')->on('ui_menu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ui_menu');
    }

}
