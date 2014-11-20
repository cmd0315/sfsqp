<?php

class AccountsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
		$admin = Account::where('id', $id)->firstOrFail();
		return View::make('account.edit.admin', ['pageTitle' => 'Change Password'], compact('admin'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//Validate the inputs
		$validator = Validator::make(Input::all(), 
			[
				'old_password' => 'required',
				'new_password' => 'required|max:50|min:6',
				'retype_new_password' => 'required|same:new_password'
			]
		);
		if($validator->fails()) {
			return 	Redirect::route('accounts.edit', $id)
					->withErrors($validator)
					->withInput();
		}

		//Get user
		$admin				= Account::where('id', $id)->firstOrFail();

		//Get form inputs
		$old_password 		= Input::get('old_password');
		$new_password 		= Input::get('new_password');

		//Check matching of provided passwords
		if(Hash::check($old_password, $admin->getAuthPassword())) {

			//Save new password
			$admin->password = $new_password;
			
			if( !($admin->save()) ) {
				Flash::error('Error: Failed saving new password!');
			}

			Flash::success('Password has been successfully changed!');
		}
		else {
			Flash::error('Old password given does not match record!');
		}

		return  Redirect::route('accounts.edit', $id);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
