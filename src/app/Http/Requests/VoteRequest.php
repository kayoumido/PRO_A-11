<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UserVoted;

class VoteRequest extends FormRequest
{
    public function all($keys = null)
    {
        $data = parent::all();
        $data['poll'] = $this->route('poll');

        return $data;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'poll' => [new UserVoted($this->route('user'))]
        ];
    }
}
