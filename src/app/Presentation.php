<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presentation extends Model
{
    public $timestamps = false;

    protected $fillable = ['title', 'date', 'conference_id'];

    /**
     * The conference of this presentation
     */
    public function conference() {
        return $this->belongsTo('App\Conference');
    }

    /**
     * List of user participating to this presentation
     */
    public function users() {
        return $this->belongsToMany('App\User')->withPivot('role', 'banned_until');
    }

    /**
     * List of questions asked during this presentation
     */
    public function questions() {
        return $this->hasMany('App\Question');
    }

    /**
     * List of polls linked to the presentation
     */
    public function polls() {
        return $this->hasMany('App\Poll');
    }
}
