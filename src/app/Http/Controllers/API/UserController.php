<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

/**
 * Class UserController
 * @package App\Http\Controllers\API
 * @group User Management
 */
class UserController extends Controller
{

    /**
     * Update the specified resource in storage.
     * @authenticated
     *
     * @responseFile responses/user.get.json
     *
     * @param Request $request
     * @param User $user
     */
    public function update(Request $request, User $user)
    {
        //
    }
}
