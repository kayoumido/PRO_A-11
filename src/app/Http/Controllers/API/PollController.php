<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PollResource;
use App\Poll;
use App\Poll\State;
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
        if (!$presentation->users()->find($request->user())) {
            return response()->json('unauthorized', Response::HTTP_UNAUTHORIZED);
        }

        return PollResource::collection($presentation->polls);
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
        if ($request->user()->id != $presentation->users()->where('role', 'presenter')->get()[0]->id) {
            return response()->json('unauthorized', Response::HTTP_UNAUTHORIZED);
        }

        $request->validate([
            'subject' => 'required|string',
        ]);

        $poll_data = $request->only([
            'subject',
        ]);
        $poll_data['status'] = 'new';
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
        if (!$poll->presentation->users()->find($request->user())) {
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
        if (!PollController::checkPresenterPrivilege($request, $poll)) {
            return response()->json('unauthorized', Response::HTTP_UNAUTHORIZED);
        }

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
        if (!PollController::checkPresenterPrivilege($request, $poll)) {
            return response()->json('unauthorized', Response::HTTP_UNAUTHORIZED);
        }

        $poll->status = State::PUBLISHED();
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
        if (!PollController::checkPresenterPrivilege($request, $poll)) {
            return response()->json('unauthorized', Response::HTTP_UNAUTHORIZED);
        }

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

    /**
     * Checks if the request's user has presenter privilege for the poll
     *
     * @param Request $request
     * @param Poll $poll
     */
    public static function checkPresenterPrivilege(Request $request, Poll $poll)
    {
        return $request->user()->id == $poll->presentation->users()->where('role', 'presenter')->get()[0]->id;
    }
}
