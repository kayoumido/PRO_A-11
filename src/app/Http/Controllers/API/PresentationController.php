<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PresentationResource;
use App\Presentation;
use App\User;
use App\User\Role;
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
     * @authenticated
     *
     * @responseFile responses/presentations.get.json
     *
     * @urlParam user required User id
     *
     * @param User $user
     */
    public function index(User $user)
    {
        return PresentationResource::collection($user->presentations);
    }

    /**
     * Create a presentation
     * @authenticated
     *
     * @responseFile responses/presentation.get.json
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
        // check that the data is valid
        $request->validate([
            'title' => 'required',
            'date' => 'required|date',
        ]);

        // create the new presentation and set the current user the presenter
        $presentation = $user->presentations()->create($request->only([
                'title',
                'date'
            ]),
            [
                'role' => Role::PRESENTER()
            ]
        );

        // return the newly created resource
        return new PresentationResource($presentation);
    }

    /**
     * Show a presentation
     * @authenticated
     *
     * @responseFile responses/presentation.get.json
     *
     * @urlParam presentation required Presentation id
     *
     * @param Presentation $presentation
     */
    public function show(Presentation $presentation)
    {
        return new PresentationResource($presentation);
    }

    /**
     * Update a presentation
     * @authenticated
     *
     * @responseFile responses/presentation.get.json
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
        $request->validate([
            'title' => 'sometimes|required',
            'date' => 'sometimes|required|date',
        ]);

        $presentation->update($request->only(['title', 'date']));
    }

    /**
     * Delete a presentation
     * @authenticated
     *
     * @urlParam presentation required Presentation id
     *
     * @param Presentation $presentation
     */
    public function destroy(Presentation $presentation)
    {
        $presentation->delete();
    }

    /**
     * Search for a presentation
     * @authenticated
     *
     * @responseFile responses/presentations.get.json
     *
     * @queryParam keywords required Keywords to search
     *
     * @param Request $request
     */
    public function search(Request $request)
    {
        $request->validate([
            'keywords' => 'required'
        ]);

        return PresentationResource::collection(
            Presentation::search($request->get('keywords'))->get()
        );
    }
}
