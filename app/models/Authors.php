<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Authors extends \Eloquent {

	use SoftDeletingTrait;
	
	protected $fillable = [];
	protected $connection = 'confsched';
	protected $table = 'authors';
	protected $appends = ['full_name', 'display'];

	public function getFullNameAttribute() {
		return $this->first_name . ' ' . $this->last_name;
	}

	public function getDisplayAttribute() {
		return $this->first_name . ' ' . $this->last_name . ' - ' . $this->email;
	}
	
	
}