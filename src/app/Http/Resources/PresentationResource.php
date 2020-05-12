<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class PresentationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if($relation = $this->users()->find(Auth::user())) {
            $role = $relation->pivot->role;
        } else {
            $role = "none";
        }

        return [
            'id'            => $this->id,
            'title'         => $this->title,
            'date'          => (string) $this->date,
            'conference_id' => $this->conference_id,
            'auth_user_role'     => $role,
        ];
    }
}
