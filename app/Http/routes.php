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
// Route::group(['middleware' => ['api-inspector']], function()
Route::group(['middleware' => []], function()
{
	Route::get('/', 'WelcomeController@index');

	Route::get('home', 'HomeController@index');

	// Route::get('/auth/facebook', 'SocialController@redirectToProvider');
	// Route::get('/facebook/callback', 'SocialController@handleProviderCallback');

	Route::post('/auth/facebook', 'SocialController@getUserFromFacebookToken');

	Route::group(['middleware' => ['mobile-auth', 'api-inspector']], function()
	{
		Route::post('/auth/check', 'Auth\AuthController@mobileAuthCheck');
		Route::get('/food', 'FoodController@index');
	    Route::post('/food', 'FoodController@add');

	    Route::post('/business', 'BusinessController@submit');
	    Route::get('/business', 'BusinessController@test');
	});

	/**
	 * API Inspection
	 */
	// Route::get('/api/inspect', 'AdminController@inspectApi');
});


// Route::controllers([
// 	'auth' => 'Auth\AuthController',
// 	'password' => 'Auth\PasswordController',
// ]);
