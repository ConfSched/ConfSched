<?php

class Paper extends \Eloquent {
	protected $fillable = [];
	protected $connection = 'openconf';
	protected $table = 'paper';
	protected $primaryKey = 'paperid';
	public $timestamps = false;
	protected $hidden = array('password');

	public function authors() {
		return $this->hasMany('Author', 'paperid', 'paperid');
	}

	public function topics() {
		return $this->belongsToMany('Topic', 'papertopic', 'paperid', 'topicid');
	}

	public function categoryPaperMap() {
		return $this->hasMany('CategoryPaperMap', 'paper_id', 'paperid');
	}
}