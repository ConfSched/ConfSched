<?php

class AuthorSessionConstraint extends \Eloquent {
	protected $fillable = [];
	protected $connection = 'confsched';
	protected $table = 'authors_sessions_constraints';

	public function author() {
		return $this->hasOne('Authors');
	}

	public function session() {
		return $this->hasOne('Sessions');
	}
	
}