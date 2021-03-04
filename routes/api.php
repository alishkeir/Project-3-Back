<?php

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

// Route::middleware('auth:api')->get('/admin', function (Request $request) {
//     return $request->admin();
// });

// Route::middleware('auth:api')->get('/student', function (Request $request) {
//     return $request->student();
// });

Route::group(['middleware' => 'api', 'prefix' => 'admin'], function () {
    Route::post('/login', 'AdminAuthController@login');
    Route::post('/register', 'AdminAuthController@register');
    Route::post('/profile', 'AdminAuthController@profile');


});
Route::resource('/students', 'StudentController');
// Route::get('/studentById/{id}', ['StudentController@show']);



Route::resource('questions','questionController');
Route::resource('schools','SchoolController');

Route::get("/admins","AdminController@index");
Route::get("/admins/{id}","AdminController@getAdminById");

Route::post("/admins/add","AdminController@store");
Route::put("/admins/edit/{id}","AdminController@update");
Route::delete("/admins/delete/{id}","AdminController@destroy");





Route::group(['middleware' => 'api', 'prefix' => 'student'], function () {
    Route::post('/login', 'StudentAuthController@login');
    Route::post('/register', 'StudentAuthController@register');
});

Route::post('/admin/logout', 'AdminAuthController@logout');
Route::post('/student/logout', 'AdminAuthController@logout');
