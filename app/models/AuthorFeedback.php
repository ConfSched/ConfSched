<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class AuthorFeedback extends \Eloquent {

	use SoftDeletingTrait;

	protected $fillable = [];
	protected $table = 'author_feedback';
}