<?php

class Permutations extends \Eloquent {

	protected $fillable = [];
	protected $table = 'permutations';
	protected $appends = [];
	public $timestamps = false;

	protected $primaryKey = null;

	public function authors() {
		return $this->hasMany('Authors', 'id', 'author');
	}

	public function sessions() {
		return $this->hasMany('Sessions', 'id', 'session');
	}

}
