<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
			$table->increments("id");
			$table->integer("paper1_id");
			$table->integer('paper2_id');
			$table->integer('user_id');
			$table->integer('interest');
			$table->integer('relevant');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
