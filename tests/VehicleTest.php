<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

/**
 * Created by PhpStorm.
 * User: Kingravi
 * Date: 30/12/2017
 * Time: 15:14
 */
class VehicleTest extends TestCase
{

    public function testGetVehicles()
    {
//        $vehicle = factory('App\Models\Vehicle')->create();

        $response = $this->call('GET', '/api/vehicles/home');

        $this->assertEquals(200, $response->status());
    }

}