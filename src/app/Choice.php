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

    /**
     * Returns the users who answered with this choice
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'poll_user')->withPivot('choice_id');
    }
}
