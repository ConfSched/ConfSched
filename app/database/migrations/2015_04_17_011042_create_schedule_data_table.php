<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateScheduleDataTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('schedule_data', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('schedule_id');
			$table->integer('session_id');
			$table->integer('paper_id');
			$table->boolean('conflict');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('schedule_data');
	}

}
