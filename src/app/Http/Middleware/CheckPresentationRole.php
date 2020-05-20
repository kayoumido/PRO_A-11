<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CheckPresentationRole
{
    /**
     * Handle an incoming request.
     * Check if the auth user has the right role to access the request
     * for multiple roles split them with , on router
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ... $roles)
    {
        if (!check_role(Auth::user()->presentations()->where('id', $request->presentation->id)->first(), $roles)) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ], Response::HTTP_UNAUTHORIZED);
        }
        return $next($request);
    }
}
