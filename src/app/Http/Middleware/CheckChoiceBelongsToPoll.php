<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class CheckChoiceBelongsToPoll
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
        if (!$request->poll->choices->contains($request->choice_id))
            return response()->json([
                'success' => false,
                'message' => 'Choice doesn\'t belong to this poll!',
            ], Response::HTTP_BAD_REQUEST);

        return $next($request);
    }
}
