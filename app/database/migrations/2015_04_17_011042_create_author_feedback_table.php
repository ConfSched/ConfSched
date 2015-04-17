<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAuthorFeedbackTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('author_feedback', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('paper1_id');
			$table->integer('paper2_id');
			$table->integer('user_id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('interest')->nullable();
			$table->integer('relevant')->nullable();
			$table->dateTime('moved_to_bottom_at')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('author_feedback');
	}

}
