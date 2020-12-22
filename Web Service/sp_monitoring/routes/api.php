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


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::middleware('auth:api')->post('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('param_upload', 'API\SPApiController@param_upload');
Route::post('param_upload', 'API\SPApiController@param_upload');

Route::get('file_state_upload', 'API\SPApiController@file_state_upload');
Route::post('file_state_upload', 'API\SPApiController@file_state_upload');

Route::any('account-detail', 'API\SPApiController@uploadAccountDetail');

Route::any('signal', 'API\SPApiController@downloadSignal');
Route::any('upload-signal', 'API\SPApiController@uploadSignal');

Route::any('gmt-offset', 'API\SPApiController@getGMTOffset');
