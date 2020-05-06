<?php

namespace App\Http\Middleware;

use Closure;
use App\Presentation;
use App\Poll\PollStatuses;
use Illuminate\Http\Response;

class PollPermsViewer
{
    /**
     * Handle an incoming request.
     *
     * Only allow admins or viewers when poll is not a draft
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // determine presentation base on request content
        $is_poll = $request->poll != null;
        $presentation = $request->presentation;
        if ($presentation == null) {
            $presentation = $request->poll->presentation;
        }

        // allow iff admin or user, and poll not draft if not a presentation
        if ($request->user()->id == $presentation->users()->where('role', 'presenter')->first()->id
            || $presentation->users()->find($request->user()->id)
            && !($is_poll && $request->poll->state == State::DRAFT())) {
            return $next($request);
        };

        return response()->json('unauthorized', Response::HTTP_UNAUTHORIZED);
    }
}
