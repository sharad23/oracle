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

Route::get('/', function()
{
	$users = DB::table('PLAN_DTL_VW')->get();
	echo '<pre>';
	print_r($users);
	echo '</pre>';
});

Route::resource('topups', 'TopupsController');
Route::post('renew','TopupsController@renew');
