<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->String('email',25)->unique()->notnull();
			$table->String('name',50);
			$table->String('password',64)->notnull();
			$table->String('remember_token',100);
			$table->String('token',500);
			$table->String('image',50);
			$table->dateTime('lastLogin');
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
	}

}
