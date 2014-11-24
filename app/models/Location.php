<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Location extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait, SoftDeletingTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'locations';
	
	/**
	 * The db table columns that can be filled
	 *
	 * @var array
     */
	protected $fillable = ['city', 'area_name'];

	/**
	* Required for soft deletion
	*
	* @var array
	*/
    protected $dates = ['deleted_at'];

 	/**
    * Many-to-one relationship between Location and Member
    */
    public function members(){
    	return $this->hasMany('Member', 'id', 'location_id');
    }

    /**
    * Return concatenated city and provincial address
    *
    * @return String
    */
    public function getCityProvinceAddressAttribute() {
    	return ucfirst($this->city) . ', ' . ucfirst($this->area_name); 
    }
}


