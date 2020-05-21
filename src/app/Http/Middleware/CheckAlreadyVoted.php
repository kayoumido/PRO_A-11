<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class CheckAlreadyVoted
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
        if ($request->user->polls->contains($request->poll))
            return response()->json([
                'success' => false,
                'message' => 'User already voted',
            ], Response::HTTP_CONFLICT);

        return $next($request);
    }
}
