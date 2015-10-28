<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUiProfileTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ui_profile', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name', 128);
            $table->tinyInteger('root')->default(0);
            $table->timestamps();
        });

        Schema::create('ui_acl', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('ui_module_action_id')->unsigned();
            $table->integer('ui_profile_id')->unsigned();
            $table->timestamps();
            $table->foreign('ui_module_action_id')->references('id')->on('ui_module_action');
            $table->foreign('ui_profile_id')->references('id')->on('ui_profile');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ui_profile');
    }

}
