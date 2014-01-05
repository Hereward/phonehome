<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfile extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

        Schema::create('countries', function($table)
        {
            $table->increments('id');
            $table->integer('code')->unsigned();
            $table->string('short_name',128);
            $table->string('name',128);
            $table->timestamps();
        });

        Schema::create('bridges', function($table)
        {
            $table->increments('id');
            $table->string('number',128);
            $table->integer('country_id')->unsigned();
            $table->foreign('country_id')->references('id')->on('countries');
            $table->timestamps();
        });

        Schema::create('origins', function($table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('name', 128);
            $table->string('number', 128);
            $table->integer('country_id')->unsigned();
            $table->foreign('country_id')->references('id')->on('countries');
            $table->timestamps();
        });

        Schema::create('profiles', function($table)
        {
            $table->increments('id');
            $table->string('name', 128);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('origin_id')->unsigned();
            $table->foreign('origin_id')->references('id')->on('origins');
            $table->string('local', 128);
            $table->integer('bridge_id')->unsigned();
            $table->foreign('bridge_id')->references('id')->on('bridges');

            $table->enum('status', array('active', 'pending', 'off'));
            $table->timestamps();
        });


        Schema::create('profile_requests', function($table)
        {
            $table->increments('id');
            $table->string('name', 128);
            $table->string('local', 128);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('country_id')->unsigned();
            $table->foreign('country_id')->references('id')->on('countries');
            $table->enum('status', array('active', 'pending', 'off'));
            $table->timestamps();
        });




	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{

		Schema::drop('profiles');
        Schema::drop('origins');
        Schema::drop('bridges');
        Schema::drop('countries');
        Schema::drop('profile_requests');

	}

}
