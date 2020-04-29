<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

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
        // get the presentation presenter
        $presenter = $request->presentation->users()->where('role', 'presenter')->first();

        if ((Auth::user()->id != $presenter->id and Auth::user()->id != $request->user->id) or
            (Auth::user()->id == $presenter->id and Auth::user()->id == $request->user->id))
            return redirect(RouteServiceProvider::HOME);

        return $next($request);
    }
}
