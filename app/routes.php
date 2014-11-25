<?php
Route::get('/', [
	'as' => 'home',
	'uses' => 'HomeController@index'
]);
Route::resource('accounts', 'AccountsController');
Route::get('admin/signin', ['as' => 'admin.signin', 'uses' => 'SessionsController@create']);
Route::resource('sessions', 'SessionsController');
Route::get('members/export', ['as' => 'members.export', 'uses' => 'MembersController@export']);
Route::get('members/restore/{id}', ['as' => 'members.restore', 'uses' => 'MembersController@restore']);
Route::resource('members', 'MembersController');
Route::get('countries/export', ['as' => 'countries.export', 'uses' => 'CountriesController@export']);
Route::get('countries/restore/{id}', ['as' => 'countries.restore', 'uses' => 'CountriesController@restore']);
Route::resource('countries', 'CountriesController', ['except' => ['create', 'edit']]);
Route::get('locations/export', ['as' => 'locations.export', 'uses' => 'LocationsController@export']);
Route::resource('locations', 'LocationsController');

/*
*
* Auuthenticated group
*
*/
Route::group(array('before' => 'auth'), function(){
	/*
	/ CSRF group
	*/
	Route::group(array('before' => 'csrf'), function(){
		
	});

	/*
	*
	* System Admin group
	*
	*/
	Route::group(array('before' => 'role'), function() {

		Route::group(array('prefix' => '/admin'), function() {
		});
	});

	/*
	/ Dashboard Index (GET)
	*/
	Route::get('/dashboard', [
		'as' => 'dashboard',
		'uses' => 'DashboardController@index'
	]);

	/*  Sign out (GET) */
	Route::get('/sign-out', [
		'as' => 'sessions.signout',
		'uses' => 'SessionsController@destroy'
	]);
});
