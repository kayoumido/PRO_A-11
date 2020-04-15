<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'date'];

    /**
     * List of users participating to this conference
     */
    public function users() {
        return $this->belongsToMany('App\User')->withPivot('role');
    }

    /**
     * List of all available presentations for this conference
     */
    public function presentations() {
        return $this->hasMany('App\Presentation');
    }
}
