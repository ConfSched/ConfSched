<?php

class PaperAuthor extends \Eloquent {
	protected $fillable = [];
	protected $connection = 'confsched';
	protected $table = 'papers_authors';
	protected $primaryKey = 'id';
	public $timestamps = true;
	
}