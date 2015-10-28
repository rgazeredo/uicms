<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUiUserTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ui_user', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('ui_profile_id')->unsigned();
            $table->string('name', 255);
            $table->string('email', 255);
            $table->string('password', 32);
            $table->tinyInteger('active')->default(0);

            $table->timestamps();
            
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
        Schema::drop('ui_user');
    }

}
