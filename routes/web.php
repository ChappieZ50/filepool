<?php

use Illuminate\Support\Facades\Route;

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


/* filepool admin routes */

Route::group(['prefix' => '/admin/', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => 'admin-auth'], function () {
    Route::get('', 'HomeController@index')->name('home');
    /* User Actions */
    Route::group(['namespace' => 'User'], function () {
        Route::resource('user', 'UserController')->only('index', 'show');
        Route::post('users/status', 'UserController@status')->name('user.status');
        Route::post('users/store', 'UserController@store')->name('user.store');
    });

    Route::resource('file', 'FileController')->only('index', 'show', 'destroy');
    Route::resource('page', 'PageController')->except('show');
    Route::resource('message', 'MessageController')->except('create', 'edit');
    Route::resource('ad', 'AdController')->only('index', 'store');

    /* Website Settings */
    Route::resource('setting', 'SettingController')->only('index', 'store');
});

/* filepool web */

Route::get('/', 'HomeController@index')->name('home');

/* Dynamic page */
Route::get('/p/{slug}', 'HomeController@page')->name('page');

Route::resource('message', 'MessageController')->only('store');

Route::group(['as' => 'user.', 'namespace' => 'User', 'middleware' => 'user-status'], function () {
    /* User - login | register | logout */
    Route::resource('login', 'LoginController')->only('index', 'store')->middleware('guest');
    Route::resource('register', 'RegisterController')->only('index', 'store')->middleware('guest');
    Route::get('logout', 'LoginController@logout')->name('logout');

    /* Google Login | DO NOT CHANGE!! */
    Route::get('auth/google/redirect', 'SocialUserController@googleLogin')->name('google.login');
    Route::get('auth/google/callback', 'SocialUserController@handleGoogleLogin')->name('google.login.handle');

    /* Facebook Login | DO NOT CHANGE!! */
    Route::get('auth/facebook/redirect', 'SocialUserController@facebookLogin')->name('facebook.login');
    Route::get('auth/facebook/callback', 'SocialUserController@handleFacebookLogin')->name('facebook.login.handle');


    Route::group(['prefix' => 'user', 'middleware' => 'auth'], function () {
        /* Redirecting to profile route */
        Route::get('/', function () {
            return redirect()->route('user.profile');
        });

        /* User profile actions */
        Route::get('profile', 'UserController@profile')->name('profile');
        Route::put('profile/update', 'UserController@update')->name('update');
        Route::put('profile/update/password', 'UserController@updatePassword')->name('update.password');
        Route::put('profile/update/avatar', 'UserController@updateAvatar')->name('update.avatar');
        Route::delete('profile/destroy/avatar', 'UserController@destroyAvatar')->name('destroy.avatar');

        Route::get('statistic', 'StatisticController@index')->name('statistic');

        Route::get('my-files', 'UserController@userFiles')->name('files');
        Route::delete('my-files/destroy/{file}', 'UserController@destroyFile')->name('file.destroy');
    });
});

// Store files
Route::post('file/store', 'FileController@store')->name('file.store');
// Download file
Route::post('fpool/download', 'FileController@downloadFile')->name('file.download');
// Show file
Route::get('fpool/{file}', 'FileController@show')->name('file.show');
