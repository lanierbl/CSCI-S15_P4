<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('users', function($table) {
            //  Primary Key
            $table->increments('id');
            //  User Attributes
            $table->string('username');
            $table->string('password');
            $table->string('email')->unique();
            $table->boolean('remember_token');
            $table->string('first_name');
            $table->string('last_name');
            $table->boolean('admin');
            $table->timestamps();
        });

        Schema::create('homes', function($table) {
            //  Primary Key
            $table->increments('id');
            //  Home Attributes
            $table->string('style');
            $table->text('desc');
            $table->string('addr_street');
            $table->string('addr_city');
            $table->char('addr_state');
            $table->integer('addr_zip');
            $table->integer('num_bed');
            $table->integer('num_bath');
            $table->integer('num_halfbath');
            $table->integer('sqrfoot');
            $table->integer('lot_sqrfoot');
            $table->integer('park_spaces');
            $table->boolean('garage');
            $table->boolean('pool');
            $table->string('pic1');
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
        Schema::drop('users');
        Schema::drop('homes');
	}

}
