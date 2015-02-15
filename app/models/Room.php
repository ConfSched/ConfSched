<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Room extends \Eloquent {

	use SoftDeletingTrait;

	protected $fillable = [];
	protected $table = 'rooms';
	
}