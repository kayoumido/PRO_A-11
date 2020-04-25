<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Send an email to the user with the reset password link
     *
     * @bodyParam email email required email of the user who makes the request
     *
     * @param Request $request
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        // generate and save the token
        $token = Str::random(60);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::to($request->email)->send(new ResetPasswordMail($token));
    }

    /**
     * Change the password
     *
     * @bodyParam token string required token to validate the request
     * @bodyParam email email required email of the user who wants to change is password
     * @bodyParam password string required the new password for the user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|string|min:6',
            'email' => 'required|email'
        ]);

        $passwordRowRequest = DB::table('password_resets')->where(['email' => $request->email, 'token' => $request->token]);
        if ($passwordRowRequest->count() > 0) {
            $user = User::where('email', $request->email)->first();
            $user->update(['password' => Hash::make($request->password)]);
            // remove all generated tokens
            DB::table('password_resets')->where('email', $request->email)->delete();
        } else {
            return response()->json(['error' => 'Token or email incorrect'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
