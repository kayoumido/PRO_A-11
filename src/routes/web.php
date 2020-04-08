<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/{any?}', 'app');

Route::resource('/login', 'Auth\LoginController');
Route::resource('/login/reset', 'Auth\ResetPasswordController');
Route::resource('/login/forgot', 'Auth\ForgotPasswordController');
Route::resource('/login/confirm', 'Auth\ConfirmPasswordController');
Route::resource('/register', 'Auth\RegisterController');
Route::resource('/verify', 'Auth\VerificationController');
