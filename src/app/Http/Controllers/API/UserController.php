<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class UserController
 * @package App\Http\Controllers\API
 * @group User Management
 */
class UserController extends Controller
{

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'fname' => 'sometimes|required|string',
            'lname' => 'sometimes|required|string',
            'email' => 'sometimes|required|email|unique:users'
        ]);

        if($user->id != $request->user()->id) {
            return response()->json('unauthorized', Response::HTTP_UNAUTHORIZED);
        }

        $user->update($request->only([
            'fname',
            'lname',
            'email'
        ]));

        return new UserResource($user);
    }
}
