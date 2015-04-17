<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
			$table->string('username', 64);
			$table->string('password', 64);
			$table->string('first_name', 64);
			$table->string('last_name', 64);
			$table->string('email');
			$table->timestamps();
			$table->string('remember_token', 100)->nullable();
			$table->boolean('committee')->nullable();
			$table->boolean('author')->nullable();
			$table->integer('author_id')->nullable();
			$table->boolean('admin')->nullable();
			$table->integer('committee_id')->nullable();
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
