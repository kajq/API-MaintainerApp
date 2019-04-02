<?php

use Illuminate\Http\Request;

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
Route::post('register', 'UserController@register');
Route::post('login', 'UserController@authenticate');
Route::get('open', 'DataController@open');

Route::group(['middleware' => ['jwt.verify']], function() {
    
    //rutas de user controller
    Route::get('user', 'UserController@getAuthenticatedUser');
    //rutas de companycontroller
    Route::get('company', 'CompanyController@index');
    Route::get('company/{id}', 'CompanyController@show');
    Route::post('company', 'CompanyController@store');
    //rutas de locationController
    Route::get('location', 'LocationController@index');
    Route::post('location', 'LocationController@store');
});
