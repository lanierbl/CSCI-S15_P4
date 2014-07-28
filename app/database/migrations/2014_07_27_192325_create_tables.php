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
            $table->engine = "InnoDB";
            //  Primary Key
            $table->increments('id');
            //  Table Timestamps - created_by, updated_at columns
            $table->timestamps();
            //  User Attributes
            $table->string('username');
            $table->string('password');
            $table->string('email')->unique();
            $table->boolean('remember_token');
            $table->string('first_name');
            $table->string('last_name');
            $table->boolean('admin');

        });

        Schema::create('homes', function($table) {
            $table->engine = "InnoDB";
            //  Primary Key
            $table->increments('id');
            //  Table Timestamps - created_by, updated_at columns
            $table->timestamps();
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
        });

        Schema::create('listings', function($table) {
            $table->engine = "InnoDB";
            //  Primary Key
            $table->increments('id');
            //  Table Timestamps - created_by, updated_at columns
            $table->timestamps();
            //  Home Attributes
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('home_id');
            $table->string('status');
            $table->integer('price');
            $table->date('listing_date');
            $table->date('status_date');
            // Foreign Keys
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('home_id')->references('id')->on('homes');
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
        Schema::drop('listings');
	}

}
