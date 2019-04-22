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
Route::post('guest/register', 'UserSonController@register');
Route::post('guest/login', 'UserSonController@authenticate');
Route::post('reconfirm', 'UserController@reconfirm');

Route::group(['middleware' => ['jwt.verify']], function() {
    
    //rutas de user controller
    Route::get('user', 'UserController@getAuthenticatedUser');
    Route::put('activate/{id}', 'UserController@Activate');
    //rutas de companycontroller
    Route::get('company', 'CompanyController@index');
    Route::get('company/{id}', 'CompanyController@show');
    Route::post('company', 'CompanyController@store');
    //rutas de locationController
    Route::get('location/{company_id}', 'LocationController@index');
    Route::post('location', 'LocationController@store');
    //rutas de AssetsController
    Route::get('asset/{id}', 'AssetsController@show'); 
    Route::get('company/{company_id}/asset', 'AssetsController@index'); 
    Route::get('assets_of_location/{location_id}', 'AssetsController@assets_of_location');
    Route::post('asset', 'AssetsController@store');
    Route::put('asset/{id}', 'AssetsController@update'); 
    Route::delete('asset/{id}', 'AssetsController@destroy'); 
    //rutas de TypesController
    Route::get('types/{user_id}', 'TypeController@index'); 
    //rutas de UserSonController
    Route::get('guest/users/{id_admin}', 'UserSonController@index');
    Route::get('guest/user/{id}', 'UserSonController@show');
    Route::put('guest/user/{id}', 'UserSonController@update'); 
    Route::delete('guest/user/{id}', 'UserSonController@destroy'); 
    //rutas de MaintenanceController
    Route::get('maintenance/{company_id}', 'MaintenanceController@index');
    Route::post('maintenance/', 'MaintenanceController@store');
});

