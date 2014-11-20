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

	protected $csvArray = [];
	
	/**
	 * The db table columns that can be filled
	 *
	 * @var array
     */
	protected $fillable = ['first_name', 'middle_name', 'last_name', 'birthdate', 'gender', 'civil_status', 'country_id', 'street_address', 'location_id', 'other_location', 'email', 'mobile', 'telephone', 'fb'];

    protected $dates = ['deleted_at'];


	/**
    * List of datatable column names that can be filtered
    *
    * @var array
    */
    protected $filter_fields = ['last_name', 'birthdate', 'gender', 'civil_status', 'country_id', 'street_address', 'city', 'email', 'created_at', 'updated_at'];

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
    * Return the selected country where the member lives
    *
    * @return String
    */
    public function getCountryNameAttribute() {
    	if($this->country_id === 0) {
    		return 'Philippines';
    	}
    	else {
    		return 'Others';
    	}
    }

    public function getGenderFormattedAttribute() {
        if($this->gender === 'M') {
            return 'Male';
        }
        else {
            return 'Female';
        }
    }
    
    public function getAddressAttribute() {
        return ucfirst($this->street_address) . ', ' . ucfirst($this->location->city_province_address) . ', ' . ucfirst($this->country_name);
    }

    /**
    * Print button that links to the facebook account of the member
    *
    * @return String(html)
    */
    public function getFBAccountAttribute() {
    	print '<a class="btn btn-xs btn-info" href="' . $this->fb . '"> FB Account </a>'; 
    }

    /**
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
    * @return Client
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


