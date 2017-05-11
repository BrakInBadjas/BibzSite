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

Route::get('/', ['as' => 'index', 'uses' => 'MainController@index']);

Auth::routes();
Route::get('/register/verify/{token}', ['as' => 'verify', 'uses' => 'Auth\RegisterController@verify']);
Route::get('/register/verify/', ['as' => 'waiting', 'uses' => 'Auth\RegisterController@waiting']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', ['as' => 'home', 'uses' => 'HomeController@index']);

    Route::post('/adtjes/collect', ['as' => 'adtjes.collect', 'uses' => 'AdtjeController@collect']);
    Route::get('/adtjes/validate', ['as' => 'adtjes.validate', 'uses' => 'AdtjeController@validation']);
    Route::resource('adtjes', 'AdtjeController');
    Route::group(['prefix' => '/adtjes/{adtje}', 'as' => 'adtjes.'], function () {
        Route::resource('validation', 'AdtjeValidationController', ['only' => [
                'store',
                'update',
            ]]);
    });

    Route::resource('quotes', 'QuoteController');

    Route::resource('buddies', 'BuddyController');

    Route::resource('profile', 'ProfileController', ['only' => [
            'show',
            'edit',
            'update',
        ]]);

    Route::post('/issues/create', ['as' => 'github.issue', 'uses' => 'GithubController@store']);
});
