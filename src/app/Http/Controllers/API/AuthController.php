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

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'string|min:6',
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
