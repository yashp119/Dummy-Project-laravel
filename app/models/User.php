<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	// disable 'updated_at' and 'created_at' 
	//public $timestamps = false;
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	//form validation rules
	public static $rules = array(
		'registration_code'=>'required|exists:registration_code,registration_code',
		'username'=>'required|alpha_num|unique:users|between:6,30',
		'email'=>'required|email|unique:users',
		'password'=>'required|alpha_num|between:6,30|same:confirm_password',
		'confirm_password'=>'required|alpha_num|between:6,30',
		'accept_term'=>'required'
		);

}
