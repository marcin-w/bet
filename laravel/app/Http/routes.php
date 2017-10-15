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
//// Authentication routes...
//Route::get('auth/login', 'Auth\AuthController@getLogin');
//Route::post('auth/login', 'Auth\AuthController@postLogin');
//Route::get('auth/logout', 'Auth\AuthController@getLogout');
//
//// Registration routes...
//Route::get('auth/register', 'Auth\AuthController@getRegister');
//Route::post('auth/register', 'Auth\AuthController@postRegister');
//
//
//Route::controllers([
//    'password' => 'Auth\PasswordController',
//]);
//
//Route::auth();

//Route::get('/', function () {
//    return view('welcome');
//});

//Route::auth();

//Route::get('/home', 'HomeController@index');

// HOME PAGE ===================================
// we dont need to use Laravel Blade
// we will return a PHP file that will hold all of our Angular content
// see the "Where to Place Angular Files" below to see ideas on how to structure your app return
//Route::get('/', function() {
//    View::make('index'); // will return app/views/index.php
//});

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

    // since we will be using this just for CRUD, we won't need create and edit
    // Angular will handle both of those forms
    // this ensures that a user can't access api/create or api/edit when there's nothing there
//    Route::resource('bets', 'BetController',
//        array('only' => array('index', 'store', 'destroy')));

//});


Route::resource('/api/bet', 'BetController');
//Route::resource('/api/bet/chart.html', 'ChartController');

Route::resource('/api/bet/{matchId}/{teamId}', 'BetController');

Route::any('{all}', function()
{
    return '404 not found';
})->where('all', '.*');


//Route::post('/api/bet','BetController', ['parameters' => [
//    'matchId' => 'matchId',
//    'teamNr' => 'teamNr',
//]]
//);

//Route::resource('/api/bet/{matchId}/{teamNr}','BetController');