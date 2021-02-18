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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::post('/registration', 'OfficeController@registration')->name('registration');
// Route::post('/log-in', 'OfficeController@login')->name('login');
// Route::get('/poems' , 'PoemController@index' )->name('poems');
// Route::get('/poems/{id}' , 'PoemsController@getSingle')->name('single_poem');
// Route::post('/create_poem' , 'PoemsController@createPoem' )->name('create_poem');
// Route::post('/poems/{id}/edit' , 'PoemsController@editSingle')->name('edit_poem');
// Route::delete('/poems/{id}/delete' , 'PoemsController@deletePoem')->name('delete_poem');
// Route::post('/poems/{id}/rate','RatingController@createRating')->name('create_rating');
// Route::post('/poems/rate','RatingController@rate')->name('create_rating2');
// Route::get('/poems/get-rating','RatingController@getCurrentRating')->name('get_rating');
// Route::post('/poems/{poem_id}/user/{user_id}/reset_rate','RatingController@resetRating')->name('reset_rating');
// Route::get('/poems/{poem_id}/get_avg_rate','RatingController@getAvgRating')->name('get_avg_rating');
Route::resources([
    'poems' => 'PoemController',
    'authors' => 'AuthorController'
]);
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('signup', 'AuthController@signup');
    Route::post('signin', 'AuthController@signin');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('user', 'AuthController@getAuthenticatedUser');
    Route::post('me', 'AuthController@me');
});
Route::group(['middleware' => ['jwt.verify']], function() {
    
    Route::get('closed', 'PoemController@closed');
    Route::get('/poem/{id}/get-rating', 'RatingController@getCurrentRating')->name('get-rating');
    Route::post('/poem/{id}/set-rating', 'RatingController@setRating')->name('set-rating');
    Route::post('/poem/{id}/reset-rating', 'RatingController@resetRating')->name('reset-rating');
    Route::get('/poem/{id}/get-avg-rating', 'RatingController@getAvgRating')->name('get-average-rating');
});

Route::get('test', 'HistoryPersonController@historyPerson');


