<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Presentation;
use App\User;
use Illuminate\Http\Request;

/**
 * Class PresentationController
 * @package App\Http\Controllers\API
 * @group Presentations management
 */
class PresentationController extends Controller
{
    /**
     * List all presentations related to a user
     *
     * @urlParam user required User id
     *
     * @param User $user
     */
    public function index(User $user)
    {
        //
    }

    /**
     * Create a presentation
     *
     * @urlParam user required User id
     * @bodyParam title string required Title of the presentation
     * @bodyParam date datetime required Starting datetime for the presentation
     *
     * @param Request $request
     * @param User $user
     */
    public function store(Request $request, User $user)
    {
        //
    }

    /**
     * Show a presentation
     *
     * @urlParam presentation required Presentation id
     *
     * @param Presentation $presentation
     */
    public function show(Presentation $presentation)
    {
        //
    }

    /**
     * Update a presentation
     *
     * @urlParam presentation required Presentation id
     * @bodyParam title string optional Title of the presentation
     * @bodyParam date datetime optional Starting datetime for the presentation
     *
     * @param Request $request
     * @param Presentation $presentation
     */
    public function update(Request $request, Presentation $presentation)
    {
        //
    }

    /**
     * Delete a presentation
     *
     * @urlParam presentation required Presentation id
     *
     * @param Presentation $presentation
     */
    public function destroy(Presentation $presentation)
    {
        //
    }

    /**
     * Search for a presentation
     *
     * @queryParam keywords required Keywords to search
     *
     * @param Request $request
     */
    public function search(Request $request)
    {
        //
    }
}
