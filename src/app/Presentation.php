<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presentation extends Model
{
    public $timestamps = false;

    protected $fillable = ['title','date'];

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
}
