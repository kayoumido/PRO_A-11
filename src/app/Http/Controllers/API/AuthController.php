<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

/**
 * Class AuthController
 * @package App\Http\Controllers\API
 * @group Authentication
 * All routes that need authentication should contain a bearer token in the headers
 * using the following synthax:<br>
 * `Authorization: Bearer <token>`
 */
class AuthController extends Controller
{
    /**
     * Log the user in
     *
     * @responseFile responses/login.get.json
     *
     * @bodyParam email email required email of the user to connect
     * @bodyParam password string required the password related to the user
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        try {
            $response = $http->post(config('services.passport.login_endpoint'), [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => config('services.passport.client_id'),
                    'client_secret' => config('services.passport.client_secret'),
                    'username' => $request->email,
                    'password' => $request->password,
                ]
            ]);
            return $response->getBody();
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            if ($e->getCode() === 400) {
                return response()->json('Invalid Request. Please enter a username or a password.', $e->getCode());
            } else if ($e->getCode() === 401) {
                return response()->json('Your credentials are incorrect. Please try again', $e->getCode());
            }

            return response()->json('Something went wrong on the server.', $e->getCode());
        }
    }

    /**
     * Create a new user account
     *
     * @responseFile responses/login.get.json
     *
     * @bodyParam fname string required User's firstname
     * @bodyParam lname string required User's lastname
     * @bodyParam email email required User's email
     * @bodyParam password string required User's password
     * @param Request $request
     * @return mixed
     */
    public function register(Request $request)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return $this->login($request);
    }

    /**
     * Sign out the user from everywere
     * @authenticated
     *
     */
    public function logout()
    {
        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
    }

    /**
     * Return the current authenticated information
     * @authenticated
     * @responseFile responses/user.get.json
     */
    public function user(Request $request)
    {
        return new UserResource($request->user());
    }
  
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
