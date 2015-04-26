<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Permutations extends \Eloquent {

	use SoftDeletingTrait;

	protected $fillable = [];
	protected $table = 'permutations';
	protected $appends = ['display_value'];
	public $timestamps = false;

	protected $primaryKey = null;

	public function authors() {
		return $this->hasMany('Authors', 'author', 'id');
	}

	public function session() {
		return $this->hasMany('Sessions', 'session', 'id');
	}

}
