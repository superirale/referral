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

Route::resource('profile', 'ProfileController');
Route::resource('bank-detail', 'BankDetailController');
Route::get('change-password', 'profileController@changePassword');
Route::post('change-password', 'profileController@changePassword');
Route::resource('donation', 'DonationController');
Route::get('received-donation', 'DonationController@recieved');
Route::get('sent-donation', 'DonationController@sent');
Route::get('upgrade', 'DonationController@create');