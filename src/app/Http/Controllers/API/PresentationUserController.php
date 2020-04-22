<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Presentation;
use App\User;
use Illuminate\Http\Request;

/**
 * Class PresentationUserController
 * @package App\Http\Controllers\API
 * @group Manage user inscriptions
 */
class PresentationUserController extends Controller
{
    /**
     * Subscribe the user to the presentation.
     *
     * @urlParam presentation required Presentation id
     * @urlParam user required User id
     *
     * @param Presentation $presentation
     * @param User $user
     */
    public function subscribe(Presentation $presentation, User $user)
    {
        // check that the user isn't already subscribed to the presentation
        if ($presentation->users()->find($user)) {
            return response()->json([
                'success' => false,
                'message' => "Already subscribed",
            ], 409);
        }

        // all gucci, the user can subscribe

        // subscribe the user to the presentation
        $presentation->users()->attach($user, [
            'role' => 'attendee'
        ]);

        // return success
        return response()->json([
            'success' => true,
            'message' => "Successfully subscribed",
        ], 200);
    }

    /**
     * Unsubscribe the user to the presentation.
     *
     * @urlParam presentation required Presentation id
     * @urlParam user required User id
     *
     * @param Presentation $presentation
     * @param User $user
     */
    public function unsubscribe(Presentation $presentation, User $user)
    {
        //
    }

    /**
     * Change the user role related to the presentation.
     *
     * @group Manage user rights on presentations
     *
     * @urlParam presentation required Presentation id
     * @urlParam user required User id
     * @bodyParam role string required the role name
     *
     * @param Request $request
     * @param Presentation $presentation
     * @param User $user
     */
    public function changeRole(Request $request, Presentation $presentation, User $user)
    {
        //
    }
}
