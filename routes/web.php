<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'TeamController@index')->name('index');


//POST http://sports-recruits-challenge3.lcl/ranking/2?value=2
Route::post('ranking/{user}', function (\App\Rankings $ranking, \Illuminate\Http\Request $request) {
	$ranking->ranking = $request->input('value');
	$ranking->user_id = $request->input('user');
	$ranking->save();

	response(200);
});
