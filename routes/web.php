<?php

use Illuminate\Support\Facades\DB;
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

Route::GET('/logout',function(Request $request)
{
	$request->session()->forget('user_name');
	return redirect('/');
});

Route::GET('/ico/ico-new',function(){
return view('ico-new');
});


Route::GET('/ads/status-update/{status}/{id}','AdminController@ajax_status_update');
Route::GET('/mining','DashboardController@mining');

Route::get('/fav_coin_list',function(){

	 $title = DB::table('settings')->where('name','title')->first();
	return view('fav_coin_list',['title'=>$title]);
});
Route::get('/fav_coin',function(){
	return view('fav_coin');
});
Route::get('/disclaimer',function(){
	return view('disclaimer');
});
Route::get('/terms',function(){
	return view('terms');
});
Route::get('/privacy',function(){
	return view('privacy');
});
Route::get('/sign_in',function(){
	 $title = DB::table('settings')->where('name','title')->first();
	return view('sign_in',['title'=>$title]);
});
Route::get('/sign_up',function(){
	$title = DB::table('settings')->where('name','title')->first();
	return view('sign-up',['title'=>$title]);
});

Route::GET('/admin/footer',function()
{
	$data = DB::table('settings')->where('name','footer')->first();
	$header = DB::table('settings')->where('name','header')->first();
	return view('Admin.footer',['data'=>$data,'header'=>$header]);
});

Route::get('admin/index','AdminController@index')->name('admin_index');
Route::POST('/admin/index','AdminController@add_ico');
Route::GET('/admin/index/delete/{id}','AdminController@delete_ico');
Route::GET('/admin/login','AdminController@login')->name('admin_login');
Route::GET('/admin/logout','LoginController@logout');
Route::POST('/admin/login','AdminController@check_login');

Route::get('/','DashboardController@index');
Route::get('/get-data','DashboardController@get_data');
Route::post('/add_user','LoginController@sign_up');
Route::post('/user_login','LoginController@login');
Route::GET('/ico','IcoController@ico');
Route::GET('/ico_view/{id}','IcoController@ico_view');
Route::GET('/news','DashboardController@news');

Route::GET('/admin/coins','AdminController@coins');
Route::GET('/admin/coins/activate/{id}','AdminController@activate_coins');
Route::GET('/admin/coins/deactivate/{id}','AdminController@deactivate_coins');
Route::GET('/admin/coins/delete/{id}', 'AdminController@delete_coin');

Route::GET('/admin/stocks', 'AdminController@stocks');
Route::GET('/admin/stocks/delete/{id}', 'AdminController@delete_stocks');
Route::POST('/admin/stocks', 'AdminController@add_stocks');

Route::GET('/admin/ads','AdminController@ads');
Route::GET('/admin/ads/activate/{id}','AdminController@activate_ads');
Route::GET('/admin/ads/deactivate/{id}','AdminController@deactivate_ads');
Route::GET('/admin/ads/delete/{id}','AdminController@ads_delete');
Route::POST('/admin/ads/script','AdminController@ads_script');

Route::GET('/getItemAjax','DashboardController@getItemAjax');
Route::GET('/getItemAjaxCopy','DashboardController@getItemAjaxCopy');
//Route::POST('/getItemAjax','DashboardController@getItemAjax');



Route::GET('/getItemAjax/{market}','DashboardController@getItemAjax_Exchange');


Route::get('/exchange/{market}','DashboardController@exchange_market');

Route::get('/getItemAjax/exchange/load','DashboardController@exchange_ajax');

Route::get('/admin/new_ico', function(){
		return view('Admin.new_ico');
});	

Route::get('/admin/basic_settings','AdminController@basic_settings');
Route::POST('/admin/footer-update','DashboardController@footer_update');

Route::get('/getItemAjax/fav_coin/load/{id}','favCoinController@showFavCoin');

Route::get('/fav_coin','favCoinController@getFavcoin')->name('fav_coin');
Route::post('/add_fav_coin','favCoinController@add_fav_coin')->name('add_fav_coin');
Route::get('/user/logout','LoginController@logout_user');
Route::GET('/{crypto}','DashboardController@single_coin');
Route::GET('/coin/{crypto}','DashboardController@single_coin_new');


Route::post('/admin/update_basic_settings','AdminController@update_basic_settings');
Route::get('/admin/basic_settings','AdminController@basic_settings');

