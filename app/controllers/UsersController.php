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
	// get
	public function missingMethod($parameters = array())
	{
		return Redirect::to('users/signin');
	}

	public function getSignin(){
		$this->layout->content = View::make('users.signin');
		$this->layout->pagename = 'Signin';
	}

	public function getLogin(){
		return Redirect::to('users/signin');
	}
	public function getSignup(){
		$this->layout->content = View::make('users.signup');
		$this->layout->pagename = 'signup';
	}

	public function getDashboard(){
		$this->layout->content = View::make('users.dashboard');
		$this->layout->pagename = 'Dashboard';
	}

	public function getRecoverpassword(){
		$this->layout->content = View::make('users.recoverpassword');
		$this->layout->pagename = 'Recoverpassword';
	}

	public function getLogout(){
		if(Auth::check())
		{
			Auth::logout();
			return Redirect::to('users/signin')->with('message','You are now logged out!')->with('messageType','success');			
		}
		else
		{
			return Redirect::to('users/signin')->with('message','Please signin first!')->with('messageType','danger');
		}
	}

	public function getLogoutnomessage(){
		if(Auth::check())
		{
			Auth::logout();
			return Redirect::intended('users/signin');			
		}
		else
		{
			return Redirect::to('users/signin');
		}
	}

	//activate email by link
	public function getEmailactivate($confirmation_token){
		$validator = Validator::make(array('confirmation_token'=>$confirmation_token),array('confirmation_token'=>'required|exists:users'));
		if($validator->passes())
		{
			$user = User::where('confirmation_token','=',$confirmation_token)->first();
			$user->user_status = 1;
			$user->confirmation_token = '';
			$user->save();
			return Redirect::to('users/signin')->with('message','Your email has been confirmed!')->with('messageType','success');
		}
		else
		{
			return Redirect::to('users/signin');
		}
	}

	//Post 
	public function postCreate(){
		//validation rules php in 'app/models/users.php'
		$validator = Validator::make(Input::all(),User::$rules);

		if ($validator->passes())
		{
			//get more user information from registration_code table
			$registration_code = Input::get('registration_code');
			$code_detail = DB::table('registration_code')->where('registration_code',$registration_code)->first();
			//check status of the registration code
			//only unused code can be registered
			if($code_detail->status != 1)
			{
				return Redirect::to('users/signup')->with('message','The registration code has been used, please contact your provider!')->with('messageType','danger');
			}	else{
				//update this code is used
				DB::table('registration_code')->where('registration_code',$registration_code)->update(array('status'=> 2));
			}

			//generate a random confirmation token
			$confirmation_token = str_random(60);
			$confirmation_link = url('users/emailactivate',$confirmation_token);
			//send welcome email and activate link
			Mail::send('emails.auth.welcome', array('email'=>Input::get('email'),'password'=>Input::get('password'),'firstname'=>Input::get('firstname'),'link'=>$confirmation_link),function($message){
				$message->to(Input::get('email'))->subject('Account Created at Quantum');
			});	

			//store into database
			$user = new User;
			$user->registration_code = Input::get('registration_code');
			$user->user_status = 0;
			$user->firstname = Input::get('firstname');
			$user->lastname = Input::get('lastname');
			$user->username = Input::get('firstname').Input::get('lastname');
			$user->email = Input::get('email');
			$user->password = Hash::make(Input::get('password'));
			$user->group_id = $code_detail->group_id;
			$user->salesforce_id = $code_detail->salesforce_id;
			$user->confirmation_token = $confirmation_token;
			$user->save();		

			return Redirect::to('users/signin')->with('message','Thanks for registering!<br><br>Please confirm your email before login.')->with('messageType','success');
		} 
		else 
		{
			return Redirect::to('users/signup')->with('message','The following errors occurred')->with('messageType','danger')->withErrors($validator)->withInput();
		}
	}

	public function postLogin(){
		if(Auth::attempt(array('email'=>Input::get('email'), 'password'=>Input::get('password')),Input::get('remember_me') === 'on'))
		{
			//check user status 1 activated, 0 not activated, 2 suspended
			if(Auth::user()->user_status == 1)
			{
				return Redirect::intended('home/welcome')->with('message','You are now logged in!')->with('messageType','success');
			}
			//account is not activated, inform user and resend confirmation email
			elseif(Auth::user()->user_status == 0)
			{
				Auth::logout();
				//generate a hidden form
				$form = Form::open(array('url'=>url('users/sendconfirmation'))).Form::hidden('email',Input::get('email')).Form::submit('Resend').Form::close();
				return Redirect::to('users/signin')->with('message',"Please confirm your email first.<br><br>Resend confirmation email, please click: ".$form )->with('messageType','danger')->withInput();
			}
			elseif(Auth::user()->user_status == 2)
			{	
				Auth::logout();
				return Redirect::to('users/signin')->with('message','Your account is suspended, please contact your Rep or web Admin.')->with('messageType','danger')->withInput();
			}
			else
			{
				Auth::logout();
				return Redirect::to('users/signin')->with('message','Your account status is invalid, please contact your Rep or web Admin.')->with('messageType','danger')->withInput();
			}
		}
		else
		{
			return Redirect::to('users/signin')->with('message','Your email/password combination was incorrect ')->with('messageType','danger')->withInput();
		}		
	}

	public function postRecoverpassword(){
		$validator = Validator::make(Input::all(),array('email'=>'required|email|exists:users'));

		if($validator->passes())
		{
			//generate a random password and update database
			$newpassword = str_random(6);
			$user = DB::table('users')->where('email',Input::get('email'))->update(array('password'=>Hash::make($newpassword)));

			Mail::send('emails.auth.recoverpassword',array('token'=>$newpassword),function($message){
				$message->to(Input::get('email'))->subject('Recover Password');
			});

			return Redirect::to('users/signin')->with('message','New password has been sent to your email address<br><br>Please use new password to signin!')->with('messageType','success');			
		}
		else
		{
			return Redirect::to('users/recoverpassword')->with('message','The following errors occurred')->with('messageType','danger')->withErrors($validator)->withInput();
		}
	}

	public function postChangepassword(){
		if(Auth::check())
		{
			$rules = array(	'password'=>'required|alpha_num',
							'newpassword'=>'required|alpha_num|between:6,30|confirmed|different:password',
							'newpassword_confirmation'=>'required|alpha_num|between:6,30');

			$validator = Validator::make(Input::all(),$rules);

			if($validator->passes())
			{
				if(Hash::check(Input::get('password'),Auth::user()->password))
				{
					$user = User::find(Auth::id());
					$user->password = Hash::make(Input::get('newpassword'));
					$user->save();

					return Redirect::back()->with('message','Password change success!')->with('messageType','success');
				}
				else
				{
					return Redirect::back()->with('message','Your password is incorrect! <br><br>Please try again or recover password!')->with('messageType','danger');
				}
			}
			else
			{
				return Redirect::back()->with('message','Failed! The following errors occurred')->with('messageType','danger')->withErrors($validator);
			}
		}
		else
		{
			return Redirect::to('users/signin')->with('message','Please signin first!')->with('messageType','danger');
		}
	}

	public function postSendconfirmation(){
		//generate a random token
		$confirmation_token = str_random(60);
		$confirmation_link = url('users/emailactivate',$confirmation_token);

		$email = Input::get('email');
		//store token in database
		$user = DB::table('users')->where('email',$email)->update(array('confirmation_token'=>$confirmation_token));

		//closure use 'use' to pass parameters
		Mail::send('emails.auth.confirmation', array('link'=>$confirmation_link),function($message) use ($email){
			$message->to($email)->subject('Activate Account');
		});

		return Redirect::to('users/signin')->with('message','Confirmation email has been sent!')->with('messageType','success');
	}

}
