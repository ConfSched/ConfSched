<?php

class Topic extends \Eloquent {
	protected $fillable = [];
	protected $connection = 'openconf';
	protected $table = 'topic';
	protected $primaryKey = 'topicid';
	public $timestamps = false;

	public function papers() {
		return $this->belongsToMany('Paper', 'papertopic', 'topicid', 'paperid');
	}
}