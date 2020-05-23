<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class CheckSameUserAsRequest
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
        if (Auth::user()->id != $request->user->id)
            return response()->json([
                'success' => false,
                'message' => "Unauthorized",
            ], Response::HTTP_UNAUTHORIZED);

        return $next($request);
    }
}
