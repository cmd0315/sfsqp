<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Country extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait, SoftDeletingTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'countries';
	
	/**
	 * The db table columns that can be filled
	 *
	 * @var array
     */
	protected $fillable = ['country_name'];

	/**
	* Required for soft delete
	*
	* @var array
	*/
    protected $dates = ['deleted_at'];


	/**
    * List of datatable column names that can be filtered
    *
    * @var array
    */
    protected $filter_fields = ['country_name', 'created_at', 'updated_at'];

    /**
    * Many-to-one relationship between Country and Member
    */
    public function members(){
        return $this->hasMany('Member', 'id', 'country_id')->withTrashed();
    }

    /**
    * Return readable date for the date duration for ex. '5 minutes ago'
    *
	* @return Carbon
	*/ 
	public function getUpdatedAtFormattedAttribute() {
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
    * @return Country
    */
    public function scopeSort($query, array $params) {
        if($this->isSortable($params)) {
            $sortBy = $params['sortBy'];
            $direction = $params['direction'];

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
                        ->where($this->table . '.country_name', 'LIKE', "%$search%")
                        ->get();
            });
        }
        else {
            return $query;
        }
    }

    /**
    * Check if the entry has already been softdeleted
    *
    * @return boolean
    */
    public function isDeleted() {
        if($this->deleted_at !== NULL) {
            return true;
        }
        else {
            return false;
        }
    }
}