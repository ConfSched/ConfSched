<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProgressTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('progress', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('stage', 64);
			$table->boolean('completed');
			$table->timestamps();
			$table->boolean('in_progress')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('progress');
	}

}
