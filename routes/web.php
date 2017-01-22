<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', 'HomeController@index');
Route::get('/test', 'TestController@index');

Route::resource('profile', 'ProfileController');
Route::resource('bank-detail', 'BankDetailController');
Route::get('change-password', 'profileController@changePassword');
Route::post('change-password', 'profileController@changePassword');
Route::resource('donation', 'DonationController');
Route::get('received-donation/{search?}', 'DonationController@recieved');
Route::get('sent-donation/{search?}', 'DonationController@sent');
Route::get('upgrade', 'DonationController@create');
Route::get('downlines', 'DownlinesController@index');
Route::get('donation/approve/{donation_id}', 'DonationController@accept');
Route::get('donation/reject/{iddonation_id}', 'DonationController@reject');
