<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class SessionPaper extends \Eloquent {

	use SoftDeletingTrait;

	protected $fillable = [];
	protected $table = 'sessionpaper';
	
}