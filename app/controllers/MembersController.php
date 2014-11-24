<?php

class MembersController extends \BaseController {

	/**
	* Array for list of civil status
	*
	* @var array
	*/
    protected $civil_status_options = ['0' => 'Single', '1' => 'Married'];

    /**
	* Constructor
	*/
	function __construct() {
		$this->beforeFilter('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$search = Request::get('q');
		$sortBy = Request::get('sortBy');
		$direction = Request::get('direction');
		$members = Member::sort(compact('sortBy', 'direction'))->search($search)->paginate(3);
		$total_members = Member::all()->count();

		return View::make('account.display.list-members', ['pageTitle' => 'List of Members'], compact('members', 'total_members', 'search'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$locations = Location::select(DB::raw('concat (city,", ",area_name) as location,id'))->orderBy('area_name')->lists('location', 'id');
		$civil_status_options = $this->civil_status_options;
		$countries = Country::orderBy('country_name')->lists('country_name', 'id');

		return View::make('account.create.member', ['pageTitle' => 'Add Member'], compact('locations', 'civil_status_options', 'countries'));
	}


	/**
	 * Store a newly created resource in accounts employees tables.
	 *
	 * @return redirect to create employee account form with specific return msg
	 */
	public function store()
	{
		$messages = array(
		    'other_location.required_if' => 'Pls input the city/province for the specified country.',
		);

		$validator = Validator::make(Input::all(), 
			[
				'first_name' => 'required|max:50|min:2',
				'middle_name' => 'required|max:50|min:2',
				'last_name' => 'required|max:50|min:2',
				'birthdate' => 'required',
				'gender' => 'required',
				'civil_status' => 'required',
				'country_id' => 'required',
				'street_address' => 'required|max:50|min:5',
				'location_id' => 'required_if:country_id,<,2',
				'other_location' => 'required_if:country_id,>,1',
				'email' => 'max:50|email|unique:members',
				'mobile' => 'max:15|min:11',
				'telephone' => 'max:15|min:7',
				'fb' => 'required'
			], $messages
		);

		if($validator->fails()) {
			return 	Redirect::route('members.create')
					->withErrors($validator)
					->withInput();
		}
		else {
			//Create member account
			$input = Input::only('first_name', 'middle_name', 'last_name', 'birthdate', 'gender', 'civil_status', 'country_id', 'street_address', 'location_id', 'other_location', 'email', 'mobile', 'telephone', 'fb');

			extract($input);

			//Add to members table
			$member = Member::create(compact('first_name', 'middle_name', 'last_name', 'birthdate', 'gender', 'civil_status', 'country_id', 'street_address', 'location_id', 'other_location', 'email', 'mobile', 'telephone', 'fb'));

			if($member) {
				Flash::success('Member account successfully created!');
			}
			else {
				Flash::error('Failed to create member profile!');
			}

			return 	Redirect::route('members.create');
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
		$member = Member::where('id', $id)->firstOrFail();
		return View::make('account.display.member', ['pageTitle' => 'Member Profile'], compact('member'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{	
		$member = Member::where('id', $id)->firstOrFail();
		$locations = Location::all();
		$civil_status_options = $this->civil_status_options;
		$countries = Country::orderBy('country_name')->lists('country_name', 'id');

		return View::make('account.edit.member', ['pageTitle' => 'Edit Member Profile'], compact('member', 'locations', 'civil_status_options', 'countries'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validator = Validator::make(Input::all(), 
			array(
				'first_name' => 'required|max:50|min:2',
				'middle_name' => 'required|max:50|min:2',
				'last_name' => 'required|max:50|min:2',
				'birthdate' => 'required',
				'gender' => 'required',
				'civil_status' => 'required',
				'country_id' => 'required',
				'street_address' => 'required|max:50|min:5',
				'location_id' => 'required_if:country_id,<,2',
				'other_location' => 'required_if:country_id,>,1',
				'email' => 'max:50|email',
				'mobile' => 'max:15|min:11',
				'telephone' => 'max:15|min:7',
				'fb' => 'required'
			)
		);

		if($validator->fails()) {
			return 	Redirect::route('members.edit', $id)
					->withErrors($validator)
					->withInput();
		}
		else {
			$member = Member::where('id', $id)->firstOrFail();
			
			$input = Input::only('first_name', 'middle_name', 'last_name', 'birthdate', 'gender', 'civil_status', 'country_id', 'street_address', 'location_id', 'other_location', 'email', 'mobile', 'telephone', 'fb');

			extract($input);

			$member->first_name = $first_name;
			$member->middle_name = $middle_name;
			$member->last_name = $last_name;
			$member->birthdate = $birthdate;
			$member->gender = $gender;
			$member->civil_status = $civil_status;
			$member->country_id = $country_id;
			$member->street_address = $street_address;

			/* Remove old entry and replace the right fields accordingly */
			if($country_id > 1) {
				$member->location_id = '';
				$member->other_location = $other_location;
			}
			else {
				$member->other_location = '';
				$member->location_id = $location_id;
			}

			$member->email = $email;
			$member->mobile = $mobile;
			$member->telephone = $telephone;
			$member->fb = $fb;

			if($member->save()) {
				Flash::success("You have successfully updated the member's profile!");
			}
			else {
				Flash::error("Failed updating the member's profile!");
			}
		}

		return Redirect::route('members.edit', $id);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$member = Member::where('id', $id)->firstOrFail();

		if($member->delete()) {
			Flash::success('You have successfully remove ' . $member->full_name . ' from the list of members');
		}
		else {
			Flash::error('Failed to remove member ' . $member->full_name . ' from the list');
		}
		return Redirect::route('members.index');
	}

	/**
	 * Export to Excel sheet the list of members
	 * EXPORT /members/export
	 *
	 * @return Excel
	 */
	public function export() {
				
		$members = Member::all();
		$csvArray = [];
		$count = 0;

		foreach($members as $member) {
			array_push($csvArray, [
				'#' => ++$count,
				'First Name' => $member->first_name,
				'Middle Name' => $member->middle_name,
				'Last Name' => $member->last_name,
				'Birthdate' => $member->birthdate,
				'Civil Status' => $member->civil_status_title,
				'Country' => $member->country_name,
				'City/Province' => $member->location->city_province_address,
				'Email' => $member->email,
				'Mobile' => $member->mobile,
				'Telephone' => $member->telephone,
				'FB Account' => $member->fb,
				'Created At' => $member['created_at']->toDateTimeString(),
				'Updated At' => $member['updated_at']->toDateTimeString()
			]);
		}

		Excel::create('List of Church Members', function($excel) use($csvArray) {

			// Set the title
		    $excel->setTitle('Church Members');

		    // Chain the setters
		    $excel->setCreator('Charisse May Dalida')
		          ->setCompany('Crist Lopez');

			$excel->sheet('Records', function($sheet) use($csvArray) {

				$sheet->with($csvArray);
				$sheet->setAutoFilter(); // Auto filter for entire sheet
				$sheet->freezeFirstRow();
				$sheet->row(1, function($row) {// Set black background

				    // call cell manipulation methods
				    $row->setFontWeight('bold');

				});

			});
		})->export('xls');

	}
}
