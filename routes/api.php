<?php

use App\Models\Role;
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

$api->version('v1', function ($api) {
    $api->get('/', function () {

        Role::create([
            'id' => 'ADMIN',
            'description' => 'greatness'
        ]);

        $appUrl = getenv('APP_URL');
        $apiName = getenv('API_NAME');

        return [
            'App URL' => $appUrl,
            'API Name' => $apiName
        ];
    });
});

/**
 * Authentication routes
 */
$api->version('v1', ['middleware' => 'bindings'], function ($api) {
    $api->group(['prefix' => 'auth'], function ($api) {
        $api->post('login', 'App\Http\Controllers\Api\V1\AuthenticateController@login');
    });
    $api->group(['prefix' => 'auth', 'middleware' => 'api.auth'], function ($api) {
        $api->get('user', 'App\Http\Controllers\Api\V1\AuthenticateController@me');
        $api->get('logout', 'App\Http\Controllers\Api\V1\AuthenticateController@logout');
        $api->get('refresh', 'App\Http\Controllers\Api\V1\AuthenticateController@refresh');
    });
});

$api->version('v1', ['middleware' => ['bindings', 'api.auth']], function ($api) {
    $api->group(['prefix' => 'settings'], function ($api) {
        $api->resource('users', 'App\Http\Controllers\Api\V1\UsersController');
    });
});
