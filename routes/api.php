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

Route::post('register', 'API\RegisterController@register');
Route::post('login', 'API\RegisterController@login');

Route::middleware('auth:api','log.route')->group( function () {
    Route::get('asset','API\AssetController@index');
    Route::get('asset/branch','API\AssetController@getBranch');
    Route::get('asset/location','API\AssetController@getLocation');
    Route::get('asset/{id}','API\AssetController@show');
    Route::post('asset/update/{id}','API\AssetController@update');
    Route::post('audit/store','API\AuditController@store');
    
});
