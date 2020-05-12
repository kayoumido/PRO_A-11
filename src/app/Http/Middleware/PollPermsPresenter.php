<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class PollPermsPresenter
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
        if ($request->poll->presenters()->contains(Auth::user())
            && $request->user()->id == Auth::user()->id) {
            return $next($request);
        };

        return response()->json('unauthorized', Response::HTTP_UNAUTHORIZED);
    }
}