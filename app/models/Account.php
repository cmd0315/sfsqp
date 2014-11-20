<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Account extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait, SoftDeletingTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'accounts';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password'];

	protected $guarded = array();
	
	/**
	 * The db table columns that can be filled
	 *
	 * @var array
     */
	protected $fillable = ['username', 'password', 'status'];

	/**
	* Enables deleted_at field
	*
	* @var array
	*/
    protected $dates = ['deleted_at'];

     /**
    * Hash password before storing to the database
    * 
    * @param String $password
    */
    public function setPasswordAttribute($password) {
    	$this->attributes['password'] = Hash::make($password);
    }


}


