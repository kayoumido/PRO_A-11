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

    Route::middleware(['auth:api'])->group(function (){
        Route::get('/me', 'API\AuthController@user');

        Route::post('/logout', 'API\AuthController@logout');
        // user management
        Route::apiResource('users', 'API\UserController')->only('update');
        // presentation management
        Route::apiResource('users.presentations', 'API\PresentationController')->shallow();
        Route::get('presentations/search', 'API\PresentationController@search')->name('presentations.search');
        // presentation inscriptions
        Route::post('presentations/{presentation}/users/{user}', 'API\PresentationUserController@subscribe')->name('presentations.users.subscribe');
        Route::delete('presentations/{presentation}/users/{user}', 'API\PresentationUserController@unsubscribe')->name('presentations.users.unsubscribe');
        // manage user rights on presentations
        Route::put('presentations/{presentation}/users/{user}', 'API\PresentationUserController@changeRole')->name('presentations.change_role');

        // poll management
        Route::apiResource('presentations.polls', 'API\PollController')->shallow();
        Route::middleware(['poll.roles:' . App\User\Role::PRESENTER()])->group(function () {
            Route::put('presentations/{presentation}/polls', 'API\PollController@store')->name('presentations.polls.store');
            Route::put('polls/{poll}', 'API\PollController@update')->name('polls.update');
            Route::put('polls/{poll}/publish', 'API\PollController@publish')->name('polls.publish');
            Route::get('polls/{poll}/results', 'API\PollController@results')->name('polls.results');
            Route::post('polls/{poll}/choices', 'API\ChoiceController@store')->name('polls.choices.store');
        });
        Route::middleware(['poll.roles'])->group(function () {
            Route::get('presentations/{presentation}/polls', 'API\PollController@index')->name('presentations.polls.index');
            Route::get('polls/{poll}', 'API\PollController@show')->name('polls.show');
            Route::get('polls/{poll}/choices', 'API\ChoiceController@index')->name('polls.choices.index');
        });

        // Choices management
        Route::apiResource('polls.choices', 'API\ChoiceController')->except(['show'])->shallow();
        Route::post('polls/{poll}/users/{user}', 'API\PollController@vote')->name('polls.vote');
    });

});
