<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
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
		$this->beforeFilter('auth', array('only'=>array('getWelcome')));
	}

	protected $layout = "layouts.pages_main";

	public function getWelcome(){
		$this->layout->content = View::make('home.welcome');
	}

	public function getUserProfile(){
		$this->layout->content = View::make('home.user-profile');
	}

	public function showWelcome()
	{
		return View::make('hello');
	}

}
