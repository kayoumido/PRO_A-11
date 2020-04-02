<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public $timestamps = false;
    protected $fillable = ['user_id', 'presentation_id', 'question', 'signaled'];

    /**
     * Presentation where this question was asked
     */
    public function presentation() {
        return $this->belongsTo('App\Presentation');
    }

    /**
     * this one is the author of the question
     */
    public function user() {
        return $this->belongsTo('App\User');
    }

    /**
     * each relation here represents a vote for this question
     */
    public function users() {
        return $this->belongsToMany('App\User');
    }
}
