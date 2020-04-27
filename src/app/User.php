<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'lname', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * List all questions owned by the user
     */
    public function questions() {
        return $this->hasMany('App\Question');
    }

    /**
     * List all presentation subscribed by the user
     */
    public function presentations() {
        return $this->belongsToMany('App\Presentation')->withPivot('role', 'banned_until');
    }

    /**
     * List all conferences subscribed by the user
     */
    public function conferences() {
        return $this->belongsToMany('App\Conference')->withPivot('role');
    }

    /**
     * List all polls answered by the user
     */
    public function polls() {
        return $this->belongsToMany('App\Poll')->withPivot('choice_id');
    }
}
