<?php

class Reviewer extends \Eloquent {
	protected $fillable = [];
	protected $connection = 'openconf';
	protected $table = 'reviewer';
	protected $primaryKey = 'reviewerid';
	public $timestamps = false;

	public function topics() {
		return $this->belongsToMany('Topic', 'reviewertopic', 'reviewerid', 'topicid');
	}
	
}