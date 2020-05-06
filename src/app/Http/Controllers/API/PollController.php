<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PollResource;
use App\Poll;
use App\Poll\PollStatuses;
use App\Presentation;
use App\User;
use Illuminate\Http\Response;
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
     * @authenticated
     *
     * @responseFile responses/polls.get.json
     *
     * @urlParam presentation required Id of the presentation
     *
     * @param Presentation $presentation
     */
    public function index(Request $request, Presentation $presentation)
    {
        $res = PollResource::collection($presentation->polls);

        // filter drafts for viewers
        if ($res->count() > 0 && $request->user()->id != $res->first()->presenter()) {
            $res = $res->diff(Poll::whereIn('state', PollStatuses::DRAFT())->get());
        }

        return $res;
    }

    /**
     * Create a new poll
     * @authenticated
     *
     * @responseFile responses/poll.get.json
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
            'subject' => 'required|string',
        ]);

        $poll_data = $request->only([
            'subject',
        ]);
        $poll_data['status'] = PollStatuses::DRAFT();
        $poll = $presentation->polls()->create($poll_data);

        return new PollResource($poll);
    }

    /**
     * Show a poll
     * @authenticated
     *
     * @responseFile responses/poll.get.json
     *
     * @urlParam poll required Poll id
     *
     * @param Poll $poll
     */
    public function show(Request $request, Poll $poll)
    {
        if ($request->user()->id != $poll->presenter() && $poll->state == PollStatuses::DRAFT()) {
            return response()->json('unauthorized', Response::HTTP_UNAUTHORIZED);
        }

        return new PollResource($poll);
    }

    /**
     * Update a poll
     * @authenticated
     *
     * @responseFile responses/poll.get.json
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
            'subject' => 'required|string'
        ]);

        $poll->update($request->only(['subject']));

        return new PollResource($poll);
    }

    /**
     * Delete a poll
     * @authenticated
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
     * @authenticated
     *
     * @responseFile responses/poll.get.json
     *
     * @ulrParam poll require Poll id
     * @param Request $request
     * @param Poll $poll
     */
    public function publish(Request $request, Poll $poll)
    {
        $poll->status = PollStatuses::PUBLISHED();
        $poll->save();

        return new PollResource($poll);
    }

    /**
     * Show results of the poll
     * @authenticated
     *
     * @responseFile responses/poll.results.json
     * @urlParam poll required Poll id
     *
     * @param Request $request
     * @param Poll $poll
     */
    public function results(Request $request, Poll $poll)
    {
        return PollResource::collection($poll->users);
    }

    /**
     * Make a user vote on a poll
     * @authenticated
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
        //
    }
}
