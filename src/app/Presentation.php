<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use App\Poll\PollStatus;
use App\User\Role;

class Presentation extends Model
{
    use Searchable;

    public $timestamps = false;

    protected $fillable = ['title', 'date', 'conference_id'];

    public function searchableAs()
    {
        return 'presentations_index';
    }

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
       ];
    }

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

    /**
     * List of non-draft polls linked to the presentation
     */
    public function nonDraftPolls() {
        return $this->polls()->where('status', '!=', PollStatus::DRAFT())->get();
    }

    /*
     * List of users moderation the presentation (presenters included)
     */
    public function moderators() {
        return $this->users()->where('role', Role::PRESENTER())->get();
    }
}
