<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Category extends \Eloquent {

	use SoftDeletingTrait;
	
	protected $fillable = [];
	protected $table = 'categories';

	public function papers() {
		return $this->belongsToMany('Paper', 'confsched.categories_papers', 'category_id', 'paper_id');
	}
}