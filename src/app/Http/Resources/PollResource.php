<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class PollResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($relation = $this->users()->find(Auth::user())) {
            $choice = $relation->pivot->choice_id;
        } else {
            $choice = "none";
        }

        return [
            'id'                => $this->id,
            'subject'           => $this->subject,
            'status'            => $this->status,
            'presentation_id'   => $this->presentation_id,
            'auth_user_choice'  => $choice
        ];
    }
}
