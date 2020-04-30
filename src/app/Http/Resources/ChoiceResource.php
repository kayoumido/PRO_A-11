<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ChoiceResource
 * @package App\Http\Resources
 * @group Poll choices
 */
class ChoiceResource extends JsonResource
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
            'id'        => $this->id,
            'message'   => $this->message,
            'poll_id'   => $this->poll_id
        ];
    }
}
