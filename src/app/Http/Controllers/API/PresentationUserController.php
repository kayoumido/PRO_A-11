<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Presentation;
use App\User;
use Illuminate\Http\Request;

class PresentationUserController extends Controller
{
    /**
     * Subscribe the user to the presentation.
     * @param Presentation
     * @param User
     * @return \Illuminate\Http\Resources\Json\ResourceResponse
     */
    public function subscribe(Request $request, Presentation $presentation, User $user)
    {
        //
    }

    /**
     * Unsubscribe the user to the presentation.
     * @param Presentation
     * @param User
     * @return \Illuminate\Http\Resources\Json\ResourceResponse
     */
    public function unsubscribe(Request $request, Presentation $presentation, User $user)
    {
        //
    }

    /**
     * Change the user role related to the presentation.
     * @param Presentation
     * @param User
     * @return \Illuminate\Http\Resources\Json\ResourceResponse
     */
    public function changeRole(Request $request, Presentation $presentation, User $user)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
