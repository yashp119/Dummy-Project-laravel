<?php

class UsersController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default user Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	public function __construct() {
		//refer: http://code.tutsplus.com/tutorials/authentication-with-laravel-4--net-35593, "Adding In the CSRF Before Filter"
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('auth', array('only'=>array('getDashboard')));
	}

	protected $layout = "layouts.users_main";

	public function getLogin(){
		$this->layout->content = View::make('users.login');
	}

	public function getRegister(){
		$this->layout->content = View::make('users.register');
	}

	public function getDashboard(){
		$this->layout->content = View::make('users.dashboard');
	}

	public function getLogout(){
		Auth::logout();
		return Redirect::to('users/login')->with('message','You are now logged out!');
	}

	public function postCreate(){
		//validation rules php in 'app/models/users.php'
		$validator = Validator::make(Input::all(),User::$rules);

		if ($validator->passes())
		{
			//get more user information from registration_code table
			$registration_code = Input::get('registration_code');
			$code_detail = DB::table('registration_code')->where('registration_code',$registration_code)->first();
			//check status of the code
			if($code_detail->status != 1)
			{
				return Redirect::to('users/register')->with('message','The registration_code has been used, please contact your provider!');
			}	else{
				//update this code is used
				DB::table('registration_code')->where('registration_code',$registration_code)->update(array('status'=> 0));
			}

			$user = new User;
			$user->registration_code = Input::get('registration_code');
			$user->username = Input::get('username');
			$user->email = Input::get('email');
			$user->password = Hash::make(Input::get('password'));
			$user->group_id = $code_detail->group_id;
			$user->salesforce_id = $code_detail->salesforce_id;
			$user->save();

			return Redirect::to('users/login')->with('message','Thanks for registering!');
		} 
		else 
		{
			return Redirect::to('users/register')->with('message','The following errors occurred')->withErrors($validator)->withInput();
		}
	}

	public function postSignin(){
		if(Auth::attempt(array('username'=>Input::get('username'),'password'=>Input::get('password')),Input::get('remember_me') === 'yes'))
		{
			return Redirect::intended('users/dashboard')->with('message','You are now logged in!');
		}
		else
		{
			return Redirect::to('users/login')->with('message','Your username/password combination was incorrect ')->withInput();
		}
	}

}
