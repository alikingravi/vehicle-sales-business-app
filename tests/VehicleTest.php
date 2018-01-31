<?php

use Illuminate\Support\Facades\Artisan;
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
    use DatabaseMigrations;

    public function testVehicleIsInsertedIntoDatabase()
    {
        factory('App\Models\Vehicle')->create([
            'registration' => 'SG08RPO'
        ]);

        $this->seeInDatabase(
            'vehicles',
                [
                    'registration' => 'SG08RPO'
                ]
        );
    }

    public function testVehicleIsCreated()
    {
        $this->post('api/vehicles/create/1', [
            'registration' => 'DF06NZY',
            'manufacturer' => 'BMW',
            'model' => '318i',
            'colour' => 'Black',
            'mileage' => 93000,
            'engine_size' => 2.0,
            'fuel_type' => 'petrol',
            'gear' => 'manual',
            'year' => '2006',
        ])
        ->seeJson([
            'registration' => 'DF06NZY'
        ]);

        $this->seeInDatabase(
            'vehicles',
            [
                'id' => 1,
                'registration' => 'DF06NZY',
            ]
        );
    }

    public function testRetrieveCreatedVehicle()
    {
        $this->post('api/vehicles/create/1', [
            'registration' => 'SG08RPO',
            'manufacturer' => 'BMW',
            'model' => '318i',
            'colour' => 'Black',
            'mileage' => 93000,
            'engine_size' => 2.0,
            'fuel_type' => 'petrol',
            'gear' => 'manual',
            'year' => '2006',
        ]);

        $this->get('api/vehicles/home/1')
            ->seeJson([
                'registration' => 'SG08RPO',
            ]);
    }

    public function testVehicleNotFound()
    {
        $this->post('api/vehicles/create/1', [
            'registration' => 'SG08RPO',
            'manufacturer' => 'BMW',
            'model' => '318i',
            'colour' => 'Black',
            'mileage' => 93000,
            'engine_size' => 2.0,
            'fuel_type' => 'petrol',
            'gear' => 'manual',
            'year' => '2006',
        ]);

        $this->seeInDatabase(
            'vehicles',
            [
                'id' => 1,
                'registration' => 'SG08RPO',
            ]
        );

        $this->notSeeInDatabase(
            'vehicles',
            [
                'id' => 2,
            ]
        );

        $this->get('api/vehicles/home/2')
            ->seeJson([
                'message' => 'No vehicles were found',
            ]);
    }

    public function testVehicleUpdated()
    {
        $vehicle = factory('App\Models\Vehicle')->create([
            'registration' => 'SG08RPO'
        ]);

        $this->seeInDatabase(
            'vehicles',
            [
                'id' => 1,
                'registration' => 'SG08RPO',
            ]
        );

        $this->post('api/vehicles/update/1/' . $vehicle->id, [
            'registration' => 'DF06NZY',
            'manufacturer' => 'BMW',
            'model' => '318i',
            'colour' => 'Black',
            'mileage' => 93000,
            'engine_size' => 2.0,
            'fuel_type' => 'petrol',
            'gear' => 'manual',
            'year' => '2006',
        ])
        ->seeJson([
            "message" => "Vehicle information has been updated successfully",
        ]);

        $this->seeInDatabase(
            'vehicles',
            [
                'id' => 1,
                'registration' => 'DF06NZY',
            ]
        );
    }
}