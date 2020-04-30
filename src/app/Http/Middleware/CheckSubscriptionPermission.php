<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class CheckSubscriptionPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $moderators = $request->presentation->moderators();

        if (!$moderators->contains(Auth::user()) and Auth::user()->id != $request->user->id)
            return response()->json([
                'success' => false,
                'message' => "Unauthorized",
            ], Response::HTTP_UNAUTHORIZED);;

        return $next($request);
    }
}
