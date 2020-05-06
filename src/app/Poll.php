<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    public $timestamps = false;

    protected $fillable = ['subject', 'status', 'presentation_id'];

    /**
     * Available choices for this poll
     */
    public function choices()
    {
        return $this->hasMany('App\Choice');
    }

    /**
     * List of users that answered to this poll
     */
    public function users()
    {
        return $this->belongsToMany('App\User')->withPivot('choice_id');
    }

    /**
     * Linked presentation
     */
    public function presentation()
    {
        return $this->belongsTo('App\Presentation');
    }

    public function presenters()
    {
        return $this->presentation->users()->where('role', 'presenter')->get();
    }
}
