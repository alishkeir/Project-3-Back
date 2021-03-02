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
Route::get('schools','SchoolController@index');
Route::get('school/{id}','SchoolController@show');
Route::post('school/create','SchoolController@store');
Route::put('school/update/{id}','SchoolController@update');
Route::delete('school/delete/{id}','SchoolController@destroy');



Route::get('question','questionController@index');
Route::get('question/{id}','questionController@show');
Route::post('question','questionController@store');
Route::put('question/{id}','questionController@update');
Route::delete('question/{id}','questionController@destroy');




Route::get('classes','ClassController@index');
Route::get('class/{id}','ClassController@show');
Route::post('newClass','ClassController@store');
Route::put('updateClass/{id}','ClassController@update');
Route::delete('deleteClass/{id}','ClassController@destroy');


Route::get('form','FormController@index');
Route::post('form/{id}','FormController@store');
Route::delete('form/{id}','FormController@destroy');

