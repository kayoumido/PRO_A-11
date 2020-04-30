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
        return PollResource::collection($presentation->polls()->get());
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
        $req_user = $request->user();
        if (!($req_user && PollController::isUserPresenter($req_user))) {
            return response()->json('unauthorized', Response::HTTP_UNAUTHORIZED);
        }

        $request->validate([
            'subject' => 'required',
            'status' => 'required'
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
     *
     * @urlParam poll required Poll id
     *
     * @param Poll $poll
     */
    public function show(Poll $poll)
    {
        if (!PollController::getRequestUser($request, $poll)) {
            return response()->json('unauthorized', Response::HTTP_UNAUTHORIZED);
        }

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
        if (!($poll->users()->find($request->user()) &&
            $poll->users()->find($request->user())->role == 'presenter')) {
            return response()->json('unauthorized', Response::HTTP_UNAUTHORIZED);
        }

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
        $req_user = $poll->users()->find($request->user());
        if (!($req_user && $req_user->role == 'presenter')) {
            return response()->json('unauthorized', Response::HTTP_UNAUTHORIZED);
        }

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
        if (!$poll->users()->find($request->user())) {
            return response()->json('unauthorized', Response::HTTP_UNAUTHORIZED);
        }

        $user->polls()->attach($poll);
    }
}
