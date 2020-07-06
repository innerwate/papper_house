<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/registration', 'OfficeController@registration')->name('registration');
Route::post('/log-in', 'OfficeController@login')->name('login');
Route::get('/poems' , 'PoemsController@getAll' )->name('poems');
Route::get('/poems/{id}' , 'PoemsController@getSingle')->name('single_poem');
Route::post('/create_poem' , 'PoemsController@createPoem' )->name('create_poem');
Route::post('/poems/{id}/edit' , 'PoemsController@editSingle')->name('edit_poem');
Route::delete('/poems/{id}/delete' , 'PoemsController@deletePoem')->name('delete_poem');
Route::post('/poems/{id}/rate','RatingController@createRating')->name('create_rating');
Route::get('/poems/{poem_id}/user/{user_id}/get_rate','RatingController@getCurrentRating')->name('get_rating');
Route::post('/poems/{poem_id}/user/{user_id}/reset_rate','RatingController@resetRating')->name('reset_rating');
Route::get('/poems/{poem_id}/get_avg_rate','RatingController@getAvgRating')->name('get_avg_rating');




