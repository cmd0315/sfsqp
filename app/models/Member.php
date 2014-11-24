<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Member extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait, SoftDeletingTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'members';

    /**
    * Required for Excel exporting of data
    *
    * @var array
    */
	protected $csvArray = [];
	
	/**
	 * The db table columns that can be filled
	 *
	 * @var array
     */
	protected $fillable = ['first_name', 'middle_name', 'last_name', 'birthdate', 'gender', 'civil_status', 'country_id', 'street_address', 'location_id', 'other_location', 'email', 'mobile', 'telephone', 'fb'];

    /**
    * Required for soft deletion
    *
    * @var array
    */
    protected $dates = ['deleted_at'];


	/**
    * List of datatable column names that can be filtered
    *
    * @var array
    */
    protected $filter_fields = ['last_name', 'birthdate', 'gender', 'civil_status', 'country_id', 'street_address', 'city', 'email', 'created_at', 'updated_at'];

    /**
    * Many-to-one relationship between Country and Member
    */
    public function country(){
        return $this->belongsTo('Country', 'country_id', 'id');
    }

    /**
    * Many-to-one relationship between Location and Member
    */
    public function location(){
    	return $this->belongsTo('Location', 'location_id', 'id');
    }

    /**
    * Return the full name of the member by concatenating the first, middlle and last names
    *
    * @return String
    */
    public function getFullNameAttribute() {
    	return ucfirst($this->first_name) . ' ' . ucfirst($this->middle_name) . ' ' . ucfirst($this->last_name);
    }

    /**
    * Return description of the given gender abbreviation
    *
    * @return String
    */
    public function getGenderFormattedAttribute() {
        if($this->gender === 'M') {
            return 'Male';
        }
        else {
            return 'Female';
        }
    }

    /**
    * Return description of civil status symbol
    *
    * @return String
    */
    public function getCivilStatusTitleAttribute() {
        if($this->civil_status > 0) {
            return 'Married';
        }
        else {
            return 'Single';
        }
    }
    
    /**
    * Return concatenated street and location address
    *
    * @return String
    */
    public function getAddressAttribute() {
        $address = ucfirst($this->street_address);

        if($this->country_id > 1) {
            $address .= ', ' . ucfirst($this->other_location);
        }
        else {
            $address .= ', ' . ucfirst($this->location->city_province_address);
        }

        $address .= ', ' . ucfirst($this->country->country_name);
        return $address;
    }

    public function getCityProvinceAddressAttribute() {
        $address = '';

        if($this->country_id > 1) {
            $address = ucfirst($this->other_location);
        }
        else {
            $address = ucfirst($this->location->city_province_address);
        }

        return $address;
    }

    /**
    * Print button that links to the facebook account of the member
    *
    * @return String(html)
    */
    public function getFBAccountAttribute() {
    	print '<a href="' . $this->fb . '"> <i class="fa fa-facebook-square fa-lg"></i> </a>'; 
    }

    /**
    * Return readable date for the date duration for ex. '5 minutes ago'
    *
	* @return Carbon
	*/ 
	public function getUpdatedAtReadableAttribute() {
        $year = date('Y', strtotime($this->updated_at));
        $month = date('m', strtotime($this->updated_at));
        $day = date('j', strtotime($this->updated_at));
        $hr = date('g', strtotime($this->updated_at));
        $min = date('i', strtotime($this->updated_at));
        $sec = date('s', strtotime($this->updated_at));
        
        return Carbon::create($year, $month, $day, $hr, $min, $sec)->diffForHumans();
    }

    /**
    * Check if sort can be performed on the datatable
    *
    * @param array $params
    * @return boolean
    */
    public function isSortable(array $params) {
        if(in_array($params['sortBy'], $this->filter_fields)) {
            return $params['sortBy'] and $params['direction'];
        }
    }

    /**
    * Sort datatable by the given database field and sort query direction
    *
    * @param array $params
    * @return Member
    */
    public function scopeSort($query, array $params) {
        if($this->isSortable($params)) {
            $sortBy = $params['sortBy'];
            $direction = $params['direction'];

            if($sortBy === 'city') {
                $table_name = $this->table . '.*';
                $table_local_key = $this->table . '.location_id';
                return $query
                        ->select($table_name)
                        ->leftJoin('locations', $table_local_key, '=', 'locations.id')
                        ->orderBy('locations.' . $sortBy, $direction);
            }
            return $query->orderBy($sortBy, $direction);
        }
        else {
            return $query;
        }
    }


    /**
    * Return table rows containing search value
    *
    * @param $query
    * @param String
    * @return $query
    */
    public function scopeSearch($query, $search) {
        if(isset($search)) {
            return $query->where(function($query) use ($search)
            {
                $table_name = $this->table . '.*';

                if(strcasecmp($search, 'Single') == 0) {
                    $search = 0;
                }
                else if(strcasecmp($search, 'Married') == 0) {
                    $search = 1;
                }

                $query->select($table_name)
                        ->where($this->table . '.first_name', 'LIKE', "%$search%")
                        ->orWhere($this->table . '.middle_name', 'LIKE', "%$search%")
                        ->orWhere($this->table . '.last_name', 'LIKE', "%$search%")
                        ->orWhere($this->table . '.civil_status', 'LIKE', "%$search%")
                        ->orWhere($this->table . '.email', 'LIKE', "%$search%")
                        ->orWhereHas('location', function($q) use ($search) {
                            $q->where('city', 'LIKE', "%$search%");
                        })
                        ->orWhereHas('location', function($q) use ($search) {
                            $q->where('area_name', 'LIKE', "%$search%");
                        })->get();
            });
        }
        else {
            return $query;
        }
    }
}


