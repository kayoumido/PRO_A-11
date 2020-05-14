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
        $error = false;
        $presentation = Auth::user()->presentations()->where('id', $request->presentation->id)->first();
        if ($presentation) {
            $user_role = $presentation->pivot->role;
            if (!in_array($user_role, $roles)) {
                $error = true;
            }
        } else {
            $error = true;
        }

        if ($error) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ], Response::HTTP_UNAUTHORIZED);
        }
        return $next($request);
    }
}
