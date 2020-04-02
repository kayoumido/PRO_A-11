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
    // Authenticated routes
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
        Route::post('polls/{poll}/users/{user}', 'API\PollController@vote')->name('polls.vote');
        // question management
        Route::apiResource('presentations.users.questions', 'API\QuestionController')->shallow();
        Route::post('questions/{question}/users/{user}/upvote', 'API\QuestionController@upvote')->name('questions.upvote');
        Route::put('questions/{question}/validate', 'API\QuestionController@answer')->name('questions.answer');
        // question moderation
        Route::post('questions/{question}/users/{user}/report', 'API\ModerateController@report')->name('questions.users.report');
        Route::put('questions/{question}/hide', 'API\ModerateController@hide')->name('questions.hide');
        Route::put('questions/{questions}/unhide', 'API\ModerateController@unhide')->name('questions.unhide');
        Route::put('presentations/{presentation}/users/{user}/ban', 'API\ModerateController@ban')->name('presentations.users.ban');
        Route::put('presentations/{presentation}/users/{user}/unban', 'API\ModerateController@unban')->name('presentations.users.unban');
    });

});
