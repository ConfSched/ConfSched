<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Sessions extends \Eloquent {

	use SoftDeletingTrait;

	protected $fillable = [];
	protected $table = 'sessions';
	protected $appends = ['display_value'];

	public function papers() {
		return $this->belongsToMany('Paper', 'confsched.sessionpaper', 'session_id', 'paper_id');
	}

	public function room() {
		return $this->hasOne('Room', 'id', 'room_id');
	}

	public function getDisplayValueAttribute() {
		return Date::parse($this->start)->format('n/j') . ' ' . Date::parse($this->start)->format('g:i A') . ' - ' . Date::parse($this->end)->format('g:i A') . ' ' . $this->room->room;
	}
	
}