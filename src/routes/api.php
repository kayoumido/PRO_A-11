<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function () {
        // login/logut
        Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
        Route::post('login', 'Auth\LoginController@login');
        Route::post('logout', 'Auth\LoginController@logout')->name('logout');

        // password handling
        Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
        Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');
        Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('password/reset', 'Auth\ForgotPasswordController@showLoginForm')->name('password.request');
        Route::post('password/reset', 'Auth\ResetPasswordController@login')->name('password.update');
        Route::get('password/reset/{token}', 'Auth\ResetPasswordController@login')->name('password.reset');

        // register
        Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
        Route::post('register', 'Auth\RegisterController@register');

        Route::middleware('auth:api')->group(function () {
                // user management
                Route::apiResource('users', 'API\UserController')->only('update');
                // presentation management
                Route::apiResource('users.presentations', 'API\PresentationController')->shallow();
                Route::get('prestations/search', 'API\PresentationController@search')->name('presentations.search');
                // presentation inscriptions
                Route::post('presentations/{presentation}/users/{user}', 'API\PresentationUserController@subscribe')->name('presentations.users.subscribe');
                Route::delete('presentations/{presentation}/users/{user}', 'API\PresentationUserController@unsubscribe')->name('presentations.users.unsubscribe');
                // manage user rights on presentations
                Route::put('presentations/{presentation}/users/{user}', 'API\PresentationUserController@changeRole')->name('presentations.change_role');
                // poll management
                Route::apiResource('presentations.polls', 'API\PollController')->shallow();
                Route::put('polls/{poll}/publish', 'API\PollController@publish')->name('polls.publish');
                Route::get('polls/{poll}/results', 'API\PollController@results')->name('polls.results');
                // Choices management
                Route::apiResource('polls.choices', 'API\ChoiceController')->except(['show'])->shallow();
                Route::post('polls/{poll}/users/{user}', 'API\PollController@vote')->name('polls.vote');
        });
});
