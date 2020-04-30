<?php

namespace App\Http\Controllers\API;

use App\Choice;
use App\Http\Resources\ChoiceResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\PollController;
use App\Poll;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

/**
 * Class ChoiceController
 * @package App\Http\Controllers\API
 * @group Choices management
 */
class ChoiceController extends Controller
{
    /**
     * List poll choices
     *
     * @urlParam    poll required id of the poll
     *
     * @param Poll $poll
     */
    public function index(Request $request, Poll $poll)
    {
        if (!PollController::getRequestUser($request, $poll)) {
            return response()->json('unauthorized', Response::HTTP_UNAUTHORIZED);
        }

        return ChoiceResource::collection($poll->choices()->get());
    }

    /**
     * Create a poll choice
     *
     * @urlParam    poll required id of the linked poll
     * @bodyParam   message string required message corresponding to the choice
     *
     * @param Request $request
     * @param  Poll $poll
     */
    public function store(Request $request, Poll $poll)
    {
        $req_user = PollController::getRequestUser($request, $poll);
        if (!($req_user && PollController::isUserPresenter($req_user))) {
            return response()->json('unauthorized', Response::HTTP_UNAUTHORIZED);
        }

        $request->validate([
            'message' => 'required'
        ]);

        $choice = $poll->choices()->create($request->only([
            'message',
        ]));

        return new ChoiceResource($choice);
    }

    /**
     * Update a poll choice
     *
     * @urlParam choice required Id of the choice to update
     * @bodyParam message string required message corresponding to the choice
     *
     * @param Request $request
     * @param Choice $choice
     */
    public function update(Request $request, Choice $choice)
    {
        //
    }

    /**
     * Delete a poll choice
     *
     * @urlParam choice required Id of the choice to delete
     *
     * @param Choice $choice
     */
    public function destroy(Choice $choice)
    {
        //
    }
}
