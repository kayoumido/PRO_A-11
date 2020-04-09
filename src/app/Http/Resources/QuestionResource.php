<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                => $this->id,
            'question'          => $this->question,
            'signaled'          => $this->signaled,
            'user_id'           => $this->user_id,
            'presentation_id'   => $this->presentation_id
        ];
    }
}
