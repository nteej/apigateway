<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\VehicleController;

use Dingo\Api\Routing\Router;

$router = app(Router::class);
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

$router->version('v1', function (Router $router) {
    $router->group(['prefix' => 'data'], function (Router $router) {
        $router->get('vehicles', [VehicleController::class, 'dataServer']);
    });
    $router->group(['prefix' => 'system'], function (Router $router) {
        $router->resource('vehicles', VehicleController::class);
        /*$router->get('vehicle/{id}', [VehicleController::class, 'index']);*/
    });
    $router->group(['prefix' => 'jserver'], function (Router $router) {
        $router->get('vehicles', [VehicleController::class, 'getFromServer']);
    });

});
//Route::get('/vehicles', [VehicleController::class, 'index']);
