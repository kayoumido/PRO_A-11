<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    protected $fillable = ['message', 'poll_id'];

    public $timestamps = false;

    /**
     * Link to the parent poll
     */
    public function poll() {
        return $this->belongsTo('App\Poll');
    }
}
