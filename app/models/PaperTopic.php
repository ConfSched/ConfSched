<?php

class PaperTopic extends \Eloquent {
    protected $fillable = [];
    protected $connection = 'openconf';
    protected $table = 'papertopic';
    public $timestamps = false;

    public function topics() {
        return $this->hasOne('Topic', 'topicid', 'topicid');
    }

    public function paper() {
        return $this->hasOne('Paper', 'paperid', 'paperid');
    }
}
