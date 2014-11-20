<?php

class SessionsController extends \BaseController {

	/**
	* Constructor
	*
	*/
	function __construct() {

		$this->beforeFilter('guest', ['except' => 'destroy']);
	}

	/**
	 * Show the form for logging in
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('signin', ['pageTitle' => 'Sign In']);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(),
			array(
				'username' => 'required|max:20|min:5|',
				'password' => 'required'
			)
		);

		if($validator->fails()) {
			//Redirect to signin page if there are validation errors 
			return 	Redirect::route('sessions.create')
					->withErrors($validator)
					->withInput();
		}
		else {

			$remember = (Input::has('remember')) ? true : false;

			$auth = Auth::attempt(array(
				'username' => Input::get('username'),
				'password' => Input::get('password')
			), $remember);

			if($auth){
				//Redirect to intended page
				return Redirect::intended('dashboard');
			}
			else {
				Flash::error('Wrong username or password.');
			}


			return  Redirect::route('admin.signin');
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	 */
	public function destroy()
	{
		Auth::logout();
		return Redirect::route('home')->with('global', "You are now logged out.");
	}


}
