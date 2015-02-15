<?php

class Author extends \Eloquent {
	protected $fillable = [];
	protected $connection = 'openconf';
	protected $table = 'author';
	protected $primaryKey = 'paperid';
	public $timestamps = false;

	public function paper() {
		return $this->hasOne('Paper', 'paperid', 'paperid');
	}
	
}