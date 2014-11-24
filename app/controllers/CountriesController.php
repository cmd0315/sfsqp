<?php

class CountriesController extends \BaseController {

	/**
	* Constructor
	*/
	function __construct() {
		$this->beforeFilter('auth');
	}
	
	/**
	 * Display a listing of the resource.
	 * GET /countries
	 *
	 * @return Response
	 */
	public function index()
	{
		$search = Request::get('q');
		$sortBy = Request::get('sortBy');
		$direction = Request::get('direction');

		$countries = Country::sort(compact('sortBy', 'direction'))->search($search)->paginate(5);
		$total_countries = Country::all()->count();

		return View::make('account.create.country', ['pageTitle' => 'List of Countries'], compact('countries', 'total_countries', 'search'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /countries
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(), 
			[
				'country_name' => 'required|max:150|min:2|unique:countries'
			]
		);

		if($validator->fails()) {
			return 	Redirect::route('countries.index')
					->withErrors($validator)
					->withInput();
		}
		else {
			//Create country account
			$input = Input::only('country_name');

			extract($input);

			//Add to countries table
			$country = Country::create(compact('country_name'));

			if($country) {
				Flash::success('Country successfully added!');
			}
			else {
				Flash::error('Error adding the country to the list!');
			}

			return 	Redirect::route('countries.index');
		}
	}

	/**
	 * Display the specified resource.
	 * GET /countries/{id}
	 *
	 * @param  int  $id
	 * @return View
	 */
	public function show($id)
	{
		$country = Country::where('id', $id)->firstOrFail();
		$country_name = 'Country <small>' . $country->country_name . '</small>';
		return View::make('account.edit.country', ['pageTitle' => $country_name], compact('country'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /countries/{id}
	 *
	 * @param  int  $id
	 * @return Redirect
	 */
	public function update($id)
	{
		$validator = Validator::make(Input::all(), 
			[
				'country_name' => 'required|max:150|min:2'
			]
		);

		if($validator->fails()) {
			return 	Redirect::route('countries.show', $id)
					->withErrors($validator)
					->withInput();
		}
		else {
			$country = Country::where('id', $id)->firstOrFail();
			
			$input = Input::only('country_name');

			extract($input);

			$country->country_name = $country_name;

			if($country->touch()) {
				Flash::success("You have successfully edited the name of the country!");
			}
			else {
				Flash::error("Failed updating the name of the country");
			}
		}

		return Redirect::route('countries.show', $id);
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /countries/{id}
	 *
	 * @param  int  $id
	 * @return Redirect
	 */
	public function destroy($id)
	{
		$country = Country::where('id', $id)->firstOrFail();

		if($country->delete()) {
			Flash::success('You have successfully remove ' . $country->country_name . ' from the list of countries');
		}
		else {
			Flash::error('Failed to remove country ' . $country->country_name . ' from the list');
		}
		return Redirect::route('countries.index');
	}

	/**
	 * Export to Excel sheet the list of countries
	 * EXPORT /countries/export
	 *
	 * @return Excel
	 */
	public function export()
	{
		$countries = Country::all();
		$csvArray = [];
		$count = 0;

		foreach($countries as $country) {
			array_push($csvArray, [
				'#' => ++$count,
				'Country Name' => $country->country_name,
				'Created At' => $country['created_at']->toDateTimeString(),
				'Updated At' => $country['updated_at']->toDateTimeString()
			]);
		}

		Excel::create('List of Church associated countries', function($excel) use($csvArray) {

			// Set the title
		    $excel->setTitle('Church associated countries');

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