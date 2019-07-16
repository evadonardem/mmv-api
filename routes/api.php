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

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['middleware' => 'bindings'], function($api) {
  $api->get('/', function() {
     $appUrl = getenv('APP_URL');
     $apiName = getenv('API_NAME');
   
     return [
       'App URL' => $appUrl,
       'API Name' => $apiName
     ];
  });
  $api->post('login', 'App\Http\Controllers\Api\V1\AuthenticateController@login');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
