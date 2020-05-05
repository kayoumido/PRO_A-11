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
        if ($request->user()->id != $request->poll->presenter()) {
            return response()->json('unauthorized', Response::HTTP_UNAUTHORIZED);
        };

        return $next($request);
    }
}
