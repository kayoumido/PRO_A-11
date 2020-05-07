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

    Route::post('login', 'API\AuthController@login');
    Route::post('register', 'API\AuthController@register');

    Route::middleware(['auth:api'])->group(function () {
        Route::get('/me', 'API\AuthController@user');

        Route::post('/logout', 'API\AuthController@logout');
        // user management
        Route::apiResource('users', 'API\UserController')->only('update');
        // presentation management
        Route::get('presentations/search', 'API\PresentationController@search')->name('presentations.search');
        Route::apiResource('users.presentations', 'API\PresentationController')->shallow();
        // presentation subscription management
        Route::middleware(['subscription.permission'])->group(function () {
            Route::post('presentations/{presentation}/users/{user}', 'API\PresentationUserController@subscribe')->name('presentations.users.subscribe');
            Route::delete('presentations/{presentation}/users/{user}', 'API\PresentationUserController@unsubscribe')->name('presentations.users.unsubscribe');
        });
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
