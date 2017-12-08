<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


// API ROUTES ==================================

Route::get('/', function () {
    view('index');
});

Route::group(['prefix' =>'api'], function()
{
    Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
    Route::post('authenticate', 'AuthenticateController@authenticate');
//    Route::get('api/authenticate/user', 'AuthenticateController@getAuthenticatedUser');
});


Route::resource('/api/bet', 'BetController');

Route::resource('/api/bet/{matchId}/{teamId}', 'BetController');

Route::any('{all}', function()
{
    return '404 not found';
})->where('all', '.*');


