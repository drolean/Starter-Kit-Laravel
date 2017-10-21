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
Route::any('/admin/notifications/{id}/dismiss', 'Backend\Notifications\NotificationController@dismiss');
Route::any('/notifications/{id}/dismiss', 'Backend\Notifications\NotificationController@dismiss');

/*! Rotas sem Login */
Route::get('auth/login', 'Auth\LoginController@showLoginForm')->name('auth.login');
Route::post('auth/login', 'Auth\LoginController@login')->name('auth.login');
Route::post('auth/logout', 'Auth\LoginController@logout')->name('auth.logout');
Route::get('auth/logout', 'Auth\LoginController@logout')->name('auth.logout');
Route::get('auth/activation/{token}', 'Auth\LoginController@activation')->name('auth.activation');
Route::get('auth/2fa', 'Auth\LoginController@valida2Fa')->name('auth.valida2fa');
Route::post('auth/2fa', ['middleware' => 'throttle:5', 'uses' => 'Auth\LoginController@postvalida2Fa'])->name('auth.valida2fa');
Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider')->name('auth.provider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('auth.provider.callback');

/*! Password Reset Email */
Route::get('password/email', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.email');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

/*! ROTAS DO FRONTEND */
Route::group(['namespace' => 'Frontend'], function () {
    Route::get('/', ['as' => 'home', 'uses' => 'FrontendController@index']);
    Route::get('/images/{folder}/{filename?}', 'FrontendController@getAvatar');
    Route::get('/manifest.json', 'FrontendController@getManifest');
});
