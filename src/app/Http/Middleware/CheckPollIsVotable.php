<?php

namespace App\Http\Middleware;

use Closure;
use App\Poll\PollStatus;
use Illuminate\Http\Response;

class CheckPollIsVotable
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
        if ($request->poll->status != PollStatus::PUBLISHED())
            return response()->json([
                'success' => false,
                'message' => "Poll isn't published!",
            ], Response::HTTP_UNAUTHORIZED);

        return $next($request);
    }
}
