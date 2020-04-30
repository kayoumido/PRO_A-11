<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PollResource;
use App\Http\Resources\PollUserResource;
use App\Poll;
use App\Presentation;
use App\User;
use App\PollUser;
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
     *
     * @urlParam poll required Poll id
     *
     * @param Poll $poll
     */
    public function show(Request $request, Poll $poll)
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
        $req_user = PollController::getRequestUser($request, $poll);
        if (!($req_user && PollController::isUserPresenter($req_user))) {
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
        $req_user = PollController::getRequestUser($request, $poll);
        if (!($req_user && PollController::isUserPresenter($req_user))) {
            return response()->json('unauthorized', Response::HTTP_UNAUTHORIZED);
        }

        $poll->status = 'published';
        $poll->save();

        return new PollResource($poll);
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
        if (!PollController::getRequestUser($request, $poll)) {
            return response()->json('unauthorized', Response::HTTP_UNAUTHORIZED);
        }

        return PollUserResource::collection($poll->users);
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
        if (!PollController::getRequestUser($request, $poll)) {
            return response()->json('unauthorized', Response::HTTP_UNAUTHORIZED);
        }

        $user->polls()->attach($poll);
    }

    /**
     * Fetch the request user from the poll's user pool, if existing
     *
     * @param Request $request
     * @param Poll $poll
     */
    public static function getRequestUser(Request $request, Poll $poll)
    {
        return $poll->users()->find($request->user());
    }

    /**
     * Determines if the given user has a presenter role
     *
     * @param $req_user
     */
    public static function isUserPresenter($req_user)
    {
        return $req_user->role == 'presenter';
    }
}
