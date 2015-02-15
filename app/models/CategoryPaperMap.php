<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class CategoryPaperMap extends \Eloquent {

	use SoftDeletingTrait;
	
	protected $fillable = [];
	protected $table = 'categories_papers';
}