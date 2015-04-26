<?php

class Permutations extends \Eloquent {

	protected $fillable = [];
	protected $table = 'permutations';
	protected $appends = ['display_value'];
	public $timestamps = false;

	protected $primaryKey = null;

	public function authors() {
		return $this->hasMany('Authors', 'id', 'author');
	}

	public function session() {
		return $this->hasMany('Sessions', 'id', 'session');
	}

}
