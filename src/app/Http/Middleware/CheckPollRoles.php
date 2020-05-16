<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CheckPollRoles
{
    /**
     * Handle an incoming request.
     * Check if the Auth user has the right role to access the requested element
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $error = false;

        $req_presentation = $request->presentation == null ? $request->poll->presentation : $request->presentation;
        $obj_presentation = Auth::user()->presentations()->where('id', $req_presentation->id)->first();
        $presentation = Presentation::find($request->poll->presentation->id)->first();

        if ($obj_presentation) {
            $user_role = $obj_presentation->pivot->role;
            if (!empty($roles) && !in_array($user_role, $roles)) {
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