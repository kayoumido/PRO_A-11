<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    public $timestamps = false;

    protected $fillable = ['subject', 'status'];

    /**
     * Available choices for this poll
     */
    public function choices() {
        return $this->hasMany('App\Choice');
    }

    /**
     * List of users that answered to this poll
     */
    public function users() {
        return $this->belongsToMany('App\User')->withPivot('choice_id');
    }
}
