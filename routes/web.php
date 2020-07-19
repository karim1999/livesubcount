<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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

Route::get('/', function(){
	if(!in_array(session('language'),["en","ar"]))
		session(['language'=>'ar']);
	\App::setLocale(session('language'));
	return view('index');
})->name('home');
Route::get('/c', function(){
	if(!in_array(session('language'),["en","ar"]))
		session(['language'=>'ar']);
	\App::setLocale(session('language'));
	return view('c');
})->name('get-count');
Route::get('/count', function(){
	if(!in_array(session('language'),["en","ar"]))
		session(['language'=>'ar']);

	\App::setLocale(session('language'));
	return view('count');
})->name('get-count-api');
Route::get('/switch_language/{lang?}', function(Request $request){
	if(!in_array(session('language'),["en","ar"]))
		session(['language'=>'ar']);

	if(isset($request->lang) && in_array($request->lang, ["ar","en"])){
		session(['language'=>$request->lang]);
	}
	else{
		if(session('language')=="ar")
			\App::setLocale("en");
		else
			\App::setLocale("ar");
	}
	\App::setLocale(session('language'));
	return redirect('/');
	//return view('count');
})->name('sitch_language');
Route::get('/update_mode', 'ApiController@update_dark_mode_session');



/*Route::get('/country/{country}/{city_name}', 'CountryController@show')->name('country.show');
Route::get('/search', 'SearchController@search')->name('search');
*/
