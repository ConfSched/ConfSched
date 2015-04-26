<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Authors extends \Eloquent {

	use SoftDeletingTrait;

	protected $fillable = [];
	protected $connection = 'confsched';
	protected $table = 'authors';
	protected $appends = ['full_name', 'display', 'print'];

	public function getFullNameAttribute() {
		return $this->first_name . ' ' . $this->last_name;
	}

	public function getDisplayAttribute() {
		return $this->first_name . ' ' . $this->last_name . ' - ' . $this->email;
	}

	public function getPrintAttribute() {
		return $this->first_name . ' ' . $this->last_name . ' (' . $this->id . ')';
	}


}
