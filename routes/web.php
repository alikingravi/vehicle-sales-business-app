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
    // Auth Check
    $router->get('authCheck', 'AuthController@checkAuthUser');
    // Register
    $router->post('register', 'AuthController@register');
    // Login
    $router->post('login', 'AuthController@login');

    // Vehicles
    $router->get('vehicles/home/{userId}', 'VehicleController@index');
    $router->post('vehicles/create/{userId}', 'VehicleController@createVehicle');
    $router->post('vehicles/update/{userId}/{vehicleId}', 'VehicleController@updateVehicle');

    // Costs
    $router->get('cost/get/{vehicleId}', 'CostController@index');
    $router->post('cost/create/{vehicleId}', 'CostController@createCosts');
    $router->post('cost/update/{vehicleId}', 'CostController@updateCosts');

    // Sales
    $router->get('sale/get/{userId}', 'SaleController@index');
    $router->post('sale/create/{userId}/{vehicleId}', 'SaleController@createSale');
    $router->post('sale/update/{vehicleId}', 'SaleController@updateSale');

    // Accounts
    $router->get('accounts/calculate/{userId}', 'AccountsController@getAccounts');
});
