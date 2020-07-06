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

// Route::get('/', function () {
//     return view('welcome');
// });
//Route::get('/', 'OfficeController@office')->name('office');

Auth::routes();
Route::get('/{any}', 'OfficeController@office')->where('any', '.*');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home', 'HomeController@index')->name('home2');

// Route::post('/registration', 'OfficeController@registration')->name('registration');
// Route::post('/log-in', 'OfficeController@login')->name('login');

// Route::post('/submit', 'OfficeController@submit');


