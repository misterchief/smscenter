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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'api'], function()
{
	/*Route::resource('authenticate', 'authenticateController', ['only' => ['index']]);
	Route::post('authenticate', 'authenticateController@authenticate');
	Route::get('authenticate/user', 'AuthenticateController@getAuthenticatedUser');*/

	Route::resource('/contacts', 'ContactsController');
	Route::resource('/team', 'TeamController');
	Route::resource('/user', 'UserController');

	Route::post('/sms', 'SmsController@sendSms');

	Route::get('/team/{id}/members', 'TeamController@members');
	Route::post('/member', 'UserController@newMember');
	Route::get('/team/{id}/{teamid}', 'TeamController@remove');
});

Route::auth();

Route::group(['as' => 'user::'], function () {
	Route::get('/home', ['as' => 'home', 'uses' => 'ChildController@create']);
	Route::get('/send', ['as' => 'send', 'uses' => 'HomeController@index']);
	Route::get('/profile', ['as' => 'profile', 'uses' => 'UserController@profile']);
	Route::get('/settings', ['as' => 'settings', 'uses' => 'UserController@settings']);
	Route::get('/help', ['as' => 'help', 'uses' => 'UserController@help']);
	Route::get('/phonebook', ['as' => 'phonebook', 'uses' => 'ContactsController@display']);
	Route::get('/team', ['as' => 'team', 'uses' => 'TeamController@display']);
	Route::get('/newteam', ['as' => 'addTeam', 'uses' => 'TeamController@create']);
	Route::get('/admin', ['as' => 'admin', 'uses' => 'AdminController@display']);
});


Route::get('/register-user', function(){
	return view('auth.register');
});
Route::get('/send-messages', function(){
	return view('sms');
});
Route::post('/register-child', 'ChildController@register');
Route::get('/search', 'ChildController@search');
Route::get('/details/{child}','ChildController@details');
Route::post('/update/{child}','ChildController@update');



Route::get('registration', function(){
	return view('pages.registration');
});
Route::get('profiles', 'ChildController@index');
Route::get('messages', 'ChildController@display');
Route::get('profile', function(){
	return view('pages.profile');
});
Route::get('reports', function(){
	return view('pages.reports');
});
