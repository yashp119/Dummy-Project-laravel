<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/** ------------------------------------------
 *  Route model binding ex. Route::model('user','User');
 *  ------------------------------------------
 */

/** ------------------------------------------
 *  Route constraint patterns ex. Route::pattern('user', '[0-9]+');
 *  ------------------------------------------
 */

/** ------------------------------------------
 *  Admin Routes
 *  ------------------------------------------
 */

/** ------------------------------------------
 *  Frontend Routes
 *  ------------------------------------------
 */

// User RESTful Routes
Route::controller('users','UsersController');


/** ------------------------------------------
 *  Test
 *  ------------------------------------------
 */
Route::get('/', function()
{
	return View::make('hello');
});


// ##########################
Route::get('test',function(){
	//return "Hello World";
	return View::make('test');
});

Route::get('home','ApiController@home');

Route::get('login',function(){
	return View::make('main');
});

//excel test
Route::get('excel/load/{filepath?}','ExcelController@load');
Route::get('excel/loadToView/{filepath?}/{sheetnum?}','ExcelController@loadToView');
Route::controller('excel','ExcelController');

//salesforce test
Route::get('/testSF', function() {
try {
		echo "<pre>";
        echo print_r(Salesforce::describeLayout('Account'));
        echo "</pre>";
} catch (Exception $e) {
    Log::error($e->getMessage());
    die($e->getMessage() . $e->getTraceAsString());
}
});

Route::get('/userinfo', function(){
	$data=array('id'=>'test','name'=>'haha','age'=>'19sui');
	return View::make('userinfo', $data);
});