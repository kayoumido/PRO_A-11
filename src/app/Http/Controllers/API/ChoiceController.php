<?php

namespace App\Http\Controllers\API;

use App\Choice;
use App\Http\Controllers\Controller;
use App\Poll;
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
     * @authenticated
     *
     * @responseFile responses/choices.get.json
     *
     * @urlParam    poll required id of the poll
     *
     * @param Poll $poll
     */
    public function index(Poll $poll)
    {
        //
    }

    /**
     * Create a poll choice
     * @authenticated
     *
     * @responseFile responses/choice.get.json
     *
     * @urlParam    poll required id of the linked poll
     * @bodyParam   message string required message corresponding to the choice
     *
     * @param Request $request
     * @param  Poll $poll
     */
    public function store(Request $request, Poll $poll)
    {
        //
    }

    /**
     * Update a poll choice
     * @authenticated
     *
     * @responseFile responses/choice.get.json
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
     * @authenticated
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
