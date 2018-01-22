<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function($router)
{
    // Vehicles
    $router->get('vehicles/home', 'VehicleController@index');
    $router->post('vehicles/create', 'VehicleController@createVehicle');

    // Costs
    $router->post('cost/create/{vehicleId}', 'CostController@addCosts');

    // Sales
    $router->post('sale/create/{vehicleId}', 'SaleController@createSale');
    $router->post('sale/update/{vehicleId}', 'SaleController@updateSale');

    // Accounts
//    $router->get('accounts/calculate/{userId}');
});

// Register
$router->post('register', 'AuthController@register');
// Login
$router->post('login', 'AuthController@login');
