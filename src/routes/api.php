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

    Route::post('password/send-reset-email', 'API\AuthController@sendResetLinkEmail');
    Route::post('password/reset', 'API\AuthController@reset');

    Route::post('login', 'API\AuthController@login');
    Route::post('register', 'API\AuthController@register');

    Route::middleware(['auth:api'])->group(function () {
        Route::get('/me', 'API\AuthController@user');

        Route::post('/logout', 'API\AuthController@logout');

        // user management
        Route::apiResource('users', 'API\UserController')->only('update');
        // presentation management
        Route::get('presentations/search', 'API\PresentationController@search')->name('presentations.search');
        Route::apiResource('users.presentations', 'API\PresentationController')
            ->only(['index', 'show', 'store'])
            ->shallow();
        Route::middleware(['presentation.role:' . App\User\Role::PRESENTER()])->group(function () {
            Route::apiResource('users.presentations', 'API\PresentationController')->only(['update', 'destroy'])->shallow();
            Route::apiResource('presentations.polls', 'API\PollController')->only(['store'])->shallow();
        });
        Route::apiResource('presentations.polls', 'API\PollController')->only(['index', 'show'])->shallow();
        // presentation subscription management
        Route::middleware(['subscription.permission'])->group(function () {
            Route::post('presentations/{presentation}/users/{user}', 'API\PresentationUserController@subscribe')->name('presentations.users.subscribe');
            Route::delete('presentations/{presentation}/users/{user}', 'API\PresentationUserController@unsubscribe')->name('presentations.users.unsubscribe');
        });
        // manage user rights on presentations
        Route::put('presentations/{presentation}/users/{user}', 'API\PresentationUserController@changeRole')->name('presentations.change_role');

        // poll management
        Route::middleware(['poll.role:' . App\User\Role::PRESENTER()])->group(function () {
            Route::apiResource('polls', 'API\PollController')->only(['update'])->shallow();
            Route::put('polls/{poll}/publish', 'API\PollController@publish')->name('polls.publish');
            Route::get('polls/{poll}/results', 'API\PollController@results')->name('polls.results');
            Route::apiResource('polls.choices', 'API\ChoiceController')->only(['store'])->shallow();
        });

        // Choices management
        Route::middleware(['choice.role:' . App\User\Role::PRESENTER()])->group(function () {
            Route::apiResource('polls.choices', 'API\ChoiceController')->only(['destroy', 'update'])->shallow();
        });

        Route::middleware(['poll.role:' . App\User\Role::ATENDEE(), 'poll.choice', 'request.user', 'poll.votable'])->group(function () {
            Route::post('polls/{poll}/users/{user}', 'API\PollController@vote')->name('polls.vote');
        });
    });

});
