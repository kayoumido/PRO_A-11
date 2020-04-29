<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PollResource;
use App\Poll;
use App\Presentation;
use App\User;
use Illuminate\Http\Request;

/**
 * Class PollController
 * @package App\Http\Controllers\API
 * @group Polls manaquement
 */
class PollController extends Controller
{
    /**
     * List all polls related to the presentation.
     *
     * @urlParam presentation required Id of the presentation
     *
     * @param Presentation $presentation
     */
    public function index(Presentation $presentation)
    {
        return PollResource::collection($presentation->polls());
    }

    /**
     * Create a new poll
     *
     * @urlParam presentation required Id of the presentation
     * @bodyParam subject string required Subject of the poll
     *
     * @param Request $request
     * @param Presentation $presentation
     */
    public function store(Request $request, Presentation $presentation)
    {
        $request->validate([
            'subject' => 'required',
            'status' => 'required'
        ]);

        $newstate = $request->only([
            'subject',
        ]);
        $newstate['status'] = 'new';

        $poll = $presentation->polls()->create($request->only($newstate));

        return new PollResource($poll);
    }

    /**
     * Show a poll
     *
     * @urlParam poll required Poll id
     *
     * @param Poll $poll
     */
    public function show(Poll $poll)
    {
        return new PollResource($poll);
    }

    /**
     * Update a poll
     *
     * @urlParam poll required Poll id
     * @bodyParam subject string required Subject of the poll
     *
     * @param Request $request
     * @param Poll $poll
     */
    public function update(Request $request, Poll $poll)
    {
        $request->validate([
            'subject' => 'required'
        ]);

        $poll->update($request->only(['subject']));
    }

    /**
     * Delete a poll
     *
     * @urlParam poll required Poll id
     *
     * @param Poll $poll
     */
    public function destroy(Poll $poll)
    {
        //
    }


    /**
     * Change the status of a poll to published
     *
     * @ulrParam poll require Poll id
     * @param Request $request
     * @param Poll $poll
     */
    public function publish(Request $request, Poll $poll)
    {
        $poll->status = 'published';
        $poll->save();
    }

    /**
     * Show results of the poll
     *
     * @urlParam poll required Poll id
     *
     * @param Request $request
     * @param Poll $poll
     */
    public function results(Request $request, Poll $poll)
    {
        return PollResource::collection($poll->users;
    }

    /**
     * Make a user vote on a poll
     *
     * @group Choices management
     * @urlParam poll required Poll id for the vote
     * @urlParam user required User id for the vote
     * @bodyParam choice_id id required Choice id for the choosed choice
     *
     * @param Request $request
     * @param Poll $poll
     * @param User $user
     */
    public function vote(Request $request, Poll $poll, User $user)
    {
        $user->polls()->attach($poll);
    }
}
