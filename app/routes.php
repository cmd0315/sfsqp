<?php
Route::get('/', [
	'as' => 'home',
	'uses' => 'HomeController@index'
]);
Route::resource('accounts', 'AccountsController');
Route::get('admin/signin', ['as' => 'admin.signin', 'uses' => 'SessionsController@create']);
Route::resource('sessions', 'SessionsController');
Route::get('members/export', ['as' => 'members.export', 'uses' => 'MembersController@export']);
Route::resource('members', 'MembersController');

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
